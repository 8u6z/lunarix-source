<?php
namespace App\Http\Controllers\General\Frontend;
use App\Helpers\Filter;
use App\Models\Groups\Group;
use App\Models\Groups\GroupClanMember;
use App\Models\Groups\GroupRole;
use App\Models\Groups\GroupUser;
use App\Models\Groups\GroupWall;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class Groups
{
    public function show(Request $request)
    {
        $group = Group::with(['owner:id,username', 'settings', 'latestStatus.author:id,username'])->findOrFail($request->query('gid'));
        if ($request->isMethod('post')) {
            $this->handleAction($request, $group);
            return redirect($this->redirectTargetAfterAction($request, $group));
        }
        $user = $request->user();
        if ($user && GroupUser::where('group_id', $group->id)->where('user_id', $user->id)->exists()) {
            return redirect('/My/Groups.aspx?gid='.$group->id);
        }
        return $this->renderShow($request, $group, null, 'groups.show');
    }

    public function showMine(Request $request)
    {
        $group = Group::with(['owner:id,username', 'settings', 'latestStatus.author:id,username'])->findOrFail($request->query('gid'));
        $user = $request->user();
        abort_unless($user, 401);
        if ($request->isMethod('post')) {
            $this->handleAction($request, $group);
            return redirect($this->redirectTargetAfterAction($request, $group));
        }
        $membership = GroupUser::with('role')->where('group_id', $group->id)->where('user_id', $user->id)->first();
        abort_unless($membership, 403, 'You are not a member of this group.');
        return $this->renderShow($request, $group, $membership, 'groups.showmine');
    }

    private function redirectTargetAfterAction(Request $request, Group $group): string
    {
        if ($request->input('action') === 'leave') {
            return '/Groups/Group.aspx?gid='.$group->id;
        }
        return '/My/Groups.aspx?gid='.$group->id;
    }

    private function handleAction(Request $request, Group $group): void
    {
        $user = $request->user();
        abort_unless($user, 401);

        switch ($request->input('action')) {
            case 'join':
                $this->join($group, $user);
                break;
            case 'leave':
                $this->leave($group, $user);
                break;
            case 'make_primary':
                $this->makePrimary($group, $user);
                break;
            case 'remove_primary':
                $this->removePrimary($group, $user);
                break;
            case 'post_status':
                $this->postStatus($request, $group, $user);
                break;
            case 'post_wall':
                $this->postWall($request, $group, $user);
                break;
            default:
                abort(400, 'Unknown action.');
        }
    }

    private function join(Group $group, $user): void
    {
        abort_if($group->locked, 403, 'This group is not accepting new members.');
        $alreadyMember = GroupUser::where('group_id', $group->id)->where('user_id', $user->id)->exists();
        if (! $alreadyMember) {
            $defaultRole = GroupRole::where('group_id', $group->id)->orderBy('rank')->firstOrFail();
            GroupUser::create(['group_id' => $group->id, 'role_id' => $defaultRole->id, 'user_id' => $user->id]);
        }
    }

    private function leave(Group $group, $user): void
    {
        abort_if($group->owner_id === $user->id, 403, 'The owner cannot leave the group.');
        $membership = GroupUser::where('group_id', $group->id)->where('user_id', $user->id)->first();
        if ($membership) {
            $membership->delete();
        }
    }

    private function makePrimary(Group $group, $user): void
    {
        $isMember = GroupUser::where('group_id', $group->id)->where('user_id', $user->id)->exists();
        abort_unless($isMember, 403);
        $user->update(['roleset' => $group->id]);
    }

    private function postStatus(Request $request, Group $group, $user): void
    {
        $this->authorizePermission($group, $user, 'post_to_group_status');
        $validated = $request->validate(['status' => 'required|string|max:255']);
        $validated['status'] = Filter::isTagged($validated['status']);
        $group->statuses()->create(['user_id' => $user->id, 'status' => $validated['status']]);
    }

    private function postWall(Request $request, Group $group, $user): void
    {
        $this->authorizePermission($group, $user, 'can_wall_post');
        $validated = $request->validate(['content' => 'required|string|max:1000']);
        $validated['content'] = Filter::isTagged($validated['content']);
        $group->wallPosts()->create(['user_id' => $user->id, 'content' => $validated['content']]);
    }

    private function authorizePermission(Group $group, $user, string $permission): void
    {
        $membership = GroupUser::with('role.permissions')->where('group_id', $group->id)->where('user_id', $user->id)->first();
        abort_unless($membership && (bool) ($membership->role->permissions->{$permission} ?? false), 403);
    }

    private function removePrimary(Group $group, $user): void
    {
        abort_unless((int) $user->roleset === $group->id, 403);
        $user->update(['roleset' => 0]);
    }

    private function renderShow(Request $request, Group $group, ?GroupUser $membership = null, string $viewName = 'groups.show'): View
    {
        $user = $request->user();
        if (! $membership && $user) {
            $membership = GroupUser::with('role')->where('group_id', $group->id)->where('user_id', $user->id)->first();
        }
        $roles = GroupRole::where('group_id', $group->id)->orderByDesc('rank')->get();
        $activeRoleId = (int) $request->query('role', $roles->first()->id ?? 0);
        $activeRole = $roles->firstWhere('id', $activeRoleId);
        $members = $activeRole ? GroupUser::with('user:id,username')->where('group_id', $group->id)->where('role_id', $activeRoleId)->paginate(10, ['*'], 'membersPage')->withQueryString() : null;
        $wallPosts = $group->wallPosts()->with('author:id,username')->latest()->paginate(10, ['*'], 'wallPage')->withQueryString();
        $canWallPost = false;
        if ($membership) {
            $membership->loadMissing('role.permissions');
            $canWallPost = (bool) ($membership->role->permissions->can_wall_post ?? false);
        }
        $clanMembers = GroupClanMember::with('user:id,username')->where('group_id', $group->id)->get();
        return view($viewName, [
            'group' => $group,
            'membership' => $membership,
            'isPrimaryGroup' => $user && (int) $user->roleset === $group->id,
            'roles' => $roles,
            'activeRole' => $activeRole,
            'members' => $members,
            'wallPosts' => $wallPosts,
            'canWallPost' => $canWallPost,
            'allies' => collect(),
            'enemies' => collect(),
            'clanMembers' => $clanMembers,
            'storeItems' => collect(),
        ]);
    }
}