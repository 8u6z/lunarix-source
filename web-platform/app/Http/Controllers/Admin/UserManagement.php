<?php
namespace App\Http\Controllers\Admin;
use App\Models\Asset;
use App\Models\Inventory;
use App\Models\User;
use App\Services\AdminAudit;
use App\Services\DiscordBot;
use App\Services\OfficialNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserManagement
{
    public function show(Request $request, User $user): View
    {
        $this->ensureManageable($request, $user, false);
        $accountActions = DB::table('admin_user_actions')->leftJoin('users as actors', 'actors.id', '=', 'admin_user_actions.actor_id')->where('admin_user_actions.target_id', $user->id)->select('admin_user_actions.*', 'actors.username as actor_name')->latest('admin_user_actions.id')->paginate(10, ['*'], 'actions_page')->appends($request->except('actions_page'));
        $reasons = DB::table('user_ban_reasons')->orderBy('reason')->get();
        $games = Asset::query()->where('creator_id', $user->id)->where('type', Asset::TYPE_PLACE)->latest('updated_at')->get();
        $createdGroups = DB::table('groups')->where('owner_id', $user->id)->latest('created_at')->get();
        $joinedGroups = DB::table('group_users')->join('groups', 'groups.id', '=', 'group_users.group_id')->leftJoin('group_roles', 'group_roles.id', '=', 'group_users.role_id')->where('group_users.user_id', $user->id)->select('groups.*', 'group_roles.role_name as member_role', 'group_roles.rank as member_rank')->orderBy('groups.name')->get();
        $friendIds = DB::table('friends')->where('user_id_one', $user->id)->pluck('user_id_two')->merge(DB::table('friends')->where('user_id_two', $user->id)->pluck('user_id_one'))->unique()->values();
        $targetFriends = User::query()->whereIn('id', $friendIds)->orderBy('username')->get(['id', 'username', 'last_activity']);
        $inventory = Inventory::query()->where('user_id', $user->id)->with('asset')->orderByDesc('obtained_at')->get();
        return view('admin.users.manage', ['targetUser' => $user, 'accountActions' => $accountActions, 'reasons' => $reasons, 'games' => $games, 'createdGroups' => $createdGroups, 'joinedGroups' => $joinedGroups, 'targetFriends' => $targetFriends, 'inventory' => $inventory]);
    }

    public function sendMessage(Request $request, User $user, OfficialNotification $notifications): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        $validated = $request->validate(['subject' => ['required', 'string', 'max:255'], 'body' => ['required', 'string', 'max:5000']]);
        $senderId = (int) config('notifications.official_sender_id', 1);
        abort_unless(User::whereKey($senderId)->exists(), 422, 'The configured official sender account must exist before staff notifications can be sent.');
        DB::transaction(function () use ($request, $user, $validated, $notifications) {
            $notifications->send($user, $validated['subject'], $validated['body']);
            $this->recordAction($request, $user, 'message.sent', ['subject' => $validated['subject']]);
        });
        return back()->with('success', 'Notification sent to '.$user->username.'.');
    }

    public function punish(Request $request, User $user): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        $validated = $request->validate(['action' => ['required', Rule::in(['warning', 'ban_1_day', 'ban_3_days', 'ban_7_days', 'permanent'])], 'mod_note' => ['required', 'string', 'max:2000'], 'reason_ids' => ['nullable', 'array'], 'reason_ids.*' => ['integer', 'exists:user_ban_reasons,id']]);
        $settings = match ($validated['action']) {
            'warning' => ['status' => 3, 'expiry' => null, 'warning' => true],
            'ban_1_day' => ['status' => 4, 'expiry' => now()->addDay(), 'warning' => false],
            'ban_3_days' => ['status' => 4, 'expiry' => now()->addDays(3), 'warning' => false],
            'ban_7_days' => ['status' => 4, 'expiry' => now()->addDays(7), 'warning' => false],
            'permanent' => ['status' => 5, 'expiry' => null, 'warning' => false]
        };
        DB::transaction(function () use ($request, $user, $validated, $settings) {
            User::whereKey($user->id)->lockForUpdate()->update(['status' => $settings['status']]);
            $banId = DB::table('user_bans')->insertGetId(['userid' => $user->id, 'moderator_id' => $request->user()->id, 'mod_note' => $validated['mod_note'], 'expiry' => $settings['expiry'], 'reasonids' => json_encode(array_values($validated['reason_ids'] ?? [])), 'is_warning' => $settings['warning'], 'created_at' => now(), 'updated_at' => now()]);
            $this->recordAction($request, $user, 'punishment.'.$validated['action'], ['ban_id' => $banId, 'note' => $validated['mod_note']]);
        });
        return back()->with('success', 'Punishment applied to '.$user->username.'.');
    }

    public function reactivate(Request $request, User $user): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        DB::transaction(function () use ($request, $user) {
            User::whereKey($user->id)->lockForUpdate()->update(['status' => 1]);
            DB::table('user_bans')->where('userid', $user->id)->whereNull('revoked_at')->update(['revoked_at' => now(), 'revoked_by' => $request->user()->id, 'updated_at' => now()]);
            $this->recordAction($request, $user, 'punishment.reactivated');
        });
        return back()->with('success', $user->username.' has been reactivated.');
    }

    public function deleteContent(Request $request, User $user): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        $request->validate(['delete_username' => ['nullable', 'boolean'], 'delete_blurb' => ['nullable', 'boolean']]);
        $deleteUsername = $request->boolean('delete_username');
        $deleteBlurb = $request->boolean('delete_blurb');
        if (! $deleteUsername && ! $deleteBlurb) {
            throw ValidationException::withMessages(['content' => 'Select at least one piece of content to delete.']);
        }
        $replacementUsername = '[ LunarixUser ('.$user->id.') ]';
        DB::transaction(function () use ($request, $user, $replacementUsername, $deleteUsername, $deleteBlurb) {
            $lockedUser = User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            $updates = [];
            if ($deleteUsername) {
                $updates['username'] = $replacementUsername;
            }
            if ($deleteBlurb) {
                $updates['description'] = '[ Content Deleted ]';
            }
            $lockedUser->update($updates);
            $this->recordAction($request, $lockedUser, 'content.deleted', ['username_reset' => $deleteUsername, 'blurb_reset' => $deleteBlurb]);
        });
        $deleted = $deleteUsername && $deleteBlurb ? 'The username and blurb were reset.' : ($deleteUsername ? 'The username was reset.' : 'The blurb was reset.');
        return back()->with('success', $deleted);
    }

    public function updateCurrency(Request $request, User $user): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        $validated = $request->validate(['operation' => ['required', Rule::in(['set', 'add', 'subtract'])], 'amount' => ['required', 'integer', 'min:0', 'max:2147483647']]);
        DB::transaction(function () use ($request, $user, $validated) {
            $lockedUser = User::whereKey($user->id)->lockForUpdate()->firstOrFail();
            $before = (int) $lockedUser->moons;
            $amount = (int) $validated['amount'];
            $after = match ($validated['operation']) {
                'set' => $amount,
                'add' => $before + $amount,
                'subtract' => $before - $amount
            };
            if ($after < 0 || $after > 2147483647) {
                throw ValidationException::withMessages(['amount' => 'That change would make the balance invalid, Please do not go over the 32-bit integer limit.']);
            }
            $lockedUser->update(['moons' => $after]);
            $this->recordAction($request, $user, 'currency.'.$validated['operation'], ['before' => $before, 'after' => $after, 'amount' => $amount]);
        });
        return back()->with('success', 'Currency balance updated.');
    }

    public function updateMembership(Request $request, User $user, DiscordBot $discord): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        $validated = $request->validate(['membership' => ['required', 'integer', Rule::in(array_keys(User::MEMBERSHIP_NAMES))]]);
        $before = (int) $user->membership;
        $user->update(['membership' => (int) $validated['membership']]);
        if ($user->discord_id) {
            $discord->syncMembershipRole($user->fresh(), (int) $validated['membership']);
        }
        $this->recordAction($request, $user, 'membership.updated', ['before' => $before, 'after' => (int) $validated['membership']]);
        return back()->with('success', 'Membership updated.');
    }

    public function grantCatalogItem(Request $request, User $user): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        $validated = $request->validate(['asset_id' => ['required', 'integer', 'exists:assets,id']]);
        $inventory = DB::transaction(function () use ($request, $user, $validated) {
            $asset = Asset::query()->lockForUpdate()->findOrFail((int) $validated['asset_id']);
            if ($asset->isPlace()) {
                throw ValidationException::withMessages(['asset_id' => 'Places cannot be granted as catalog items.']);
            }
            if ($asset->isGhosted()) {
                throw ValidationException::withMessages(['asset_id' => 'Deleted assets cannot be granted.']);
            }
            if (! $asset->isPubliclyAvailable()) {
                throw ValidationException::withMessages(['asset_id' => 'This asset is not approved for public use.']);
            }
            if (! ($asset->is_limited || $asset->is_limited_unique) && Inventory::where('user_id', $user->id)->where('asset_id', $asset->id)->exists()) {
                throw ValidationException::withMessages(['asset_id' => 'This user already owns that item.']);
            }
            $serial = null;
            if ($asset->is_limited_unique) {
                if ($asset->limited_quantity !== null && $asset->sales_count >= $asset->limited_quantity) {
                    throw ValidationException::withMessages(['asset_id' => 'Every copy of this Limited Unique item has already been issued.']);
                }
                $serial = ((int) Inventory::where('asset_id', $asset->id)->max('serial_number')) + 1;
                if ($asset->limited_quantity !== null && $serial > $asset->limited_quantity) {
                    throw ValidationException::withMessages(['asset_id' => 'No Limited Unique serial numbers remain.']);
                }
                $asset->sales_count = max((int) $asset->sales_count + 1, $serial);
                $asset->save();
            }
            $copy = Inventory::create(['user_id' => $user->id, 'asset_id' => $asset->id, 'asset_type' => $asset->type, 'obtained_at' => now(), 'serial_number' => $serial, 'guid' => (string) Str::uuid()]);
            $this->recordAction($request, $user, 'inventory.item_granted', ['inventory_id' => $copy->id, 'asset_id' => $asset->id, 'asset_name' => $asset->name, 'serial_number' => $serial]);
            return $copy->load('asset');
        });
        return back()->with('success', ($inventory->asset?->name ?? 'Catalog item').' was granted to '.$user->username.'.');
    }

    public function revokeCatalogItem(Request $request, User $user, Inventory $inventory): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        abort_unless((int) $inventory->user_id === (int) $user->id, 404);
        $assetName = $inventory->asset?->name ?? 'Catalog item';
        DB::transaction(function () use ($request, $user, $inventory, $assetName) {
            $copy = Inventory::query()->lockForUpdate()->findOrFail($inventory->id);
            abort_unless((int) $copy->user_id === (int) $user->id, 404);
            DB::table('private_sales')->where('guid', $copy->guid)->delete();
            $copy->delete();
            if (! Inventory::where('user_id', $user->id)->where('asset_id', $copy->asset_id)->exists()) {
                DB::table('user_accoutrements')->where('user_id', $user->id)->where('asset_id', $copy->asset_id)->delete();
                $user->markRendersOutdated();
            }
            $this->recordAction($request, $user, 'inventory.item_revoked', ['inventory_id' => $copy->id, 'asset_id' => $copy->asset_id, 'asset_name' => $assetName, 'serial_number' => $copy->serial_number]);
        });
        return back()->with('success', $assetName.' was revoked from '.$user->username.'.');
    }

    public function updateStaffRole(Request $request, User $user): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        $actorRole = (int) $request->user()->roleset;
        $validated = $request->validate(['roleset' => ['required', 'integer', 'min:0', 'max:7']]);
        $newRole = (int) $validated['roleset'];
        if ($newRole >= $actorRole) {
            throw ValidationException::withMessages(['roleset' => 'You cannot assign a staff rank equal to or higher than your own.']);
        }
        $before = (int) $user->roleset;
        $user->update(['roleset' => $newRole]);
        $this->recordAction($request, $user, 'staff_role.updated', ['before' => $before, 'before_name' => User::ROLESET_NAMES[$before] ?? 'Unknown', 'after' => $newRole, 'after_name' => User::ROLESET_NAMES[$newRole] ?? 'Unknown']);
        return back()->with('success', 'Staff rank updated.');
    }

    public function sendDiscordPasswordReset(Request $request, User $user, DiscordBot $bot): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        abort_unless($user->discord_id, 422, 'This user has no linked Discord account.');
        $bot->sendApproval($user, (string) $user->discord_id, 'password_reset', 'A Lunarix staff member requested a password reset for '.$user->username.' ('.$user->id.').');
        $this->recordAction($request, $user, 'discord.password_reset_sent');
        return back()->with(['success' => 'A password reset link was sent to the user\'s Discord account.', 'discord_notice' => 'Password reset link sent. Ask the user to check their Discord DMs.']);
    }

    public function requestDiscordLink(Request $request, User $user, DiscordBot $bot): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        $validated = $request->validate(['discord_id' => ['required', 'regex:/^[0-9]{17,20}$/']]);
        abort_if(User::where('discord_id', $validated['discord_id'])->where('id', '!=', $user->id)->exists(), 422, 'That Discord account is already linked.');
        $bot->user($validated['discord_id']);
        $bot->sendApproval($user, $validated['discord_id'], 'link', 'A Lunarix staff member requested to link this Discord account to '.$user->username.' ('.$user->id.').');
        $this->recordAction($request, $user, 'discord.link_requested', ['discord_id' => $validated['discord_id']]);
        return back()->with(['success' => 'The Discord account was sent an approval link.', 'discord_notice' => 'Approval link sent. The Discord user must check their DMs to continue linking.']);
    }

    public function requestDiscordUnlink(Request $request, User $user, DiscordBot $bot): RedirectResponse
    {
        $this->ensureManageable($request, $user);
        abort_unless($user->discord_id, 422, 'This user has no linked Discord account.');
        $bot->sendApproval($user, (string) $user->discord_id, 'unlink', 'A Lunarix staff member requested to unlink this Discord account from '.$user->username.' ('.$user->id.').');
        $this->recordAction($request, $user, 'discord.unlink_requested');
        return back()->with(['success' => 'The linked Discord account was sent an unlink approval link.', 'discord_notice' => 'Unlink approval sent. The user must check their Discord DMs to continue.']);
    }

    private function ensureManageable(Request $request, User $target, bool $mutation = true): void
    {
        $actor = $request->user();
        abort_unless($actor, 403);
        if ($mutation && (int) $actor->roleset !== 7) {
            abort_if($actor->id === $target->id, 403, 'You cannot modify your own account here.');
            abort_if((int) $target->roleset >= (int) $actor->roleset, 403, 'You cannot modify an account with an equal or higher role.');
        }
    }

    private function recordAction(Request $request, User $target, string $action, array $details = []): void
    {
        AdminAudit::record($action, $details, $target->id, $request->user()->id);
    }
}
