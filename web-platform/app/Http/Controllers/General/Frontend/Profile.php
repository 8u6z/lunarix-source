<?php
namespace App\Http\Controllers\General\Frontend;
use App\Http\Controllers\AuthController;
use App\Models\Asset;
use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Profile
{
    public function userProfile(Request $request, $id)
    {
        $authController = app(AuthController::class);
        $currentUser = $authController->getAuthenticatedUser($request);
        $profileId = $id;
        $isOwnProfile = $currentUser && $currentUser->id == $id;
        $userprofile = User::select('id', 'moons', 'username', 'blurb', 'last_activity', 'description', 'created_at', 'is_kattus', 'membership', 'discord_membership', 'status', 'knockout')->where('id', $profileId)->first();
        abort_if(! $userprofile, 404);
        abort_if($userprofile->status == 5, 404);
        if ($userprofile->description && str_contains($userprofile->description, '${bytes}')) {
            $userprofile->description = str_replace('${bytes}', 'Bytes ['.number_format($userprofile->moons ?? 0).']', $userprofile->description);
        }
        $isFriend = false;
        $requestPending = false;
        $receivedRequest = false;
        $incomingFriendRequestId = 0;
        $maySendFriendInvitation = false;
        if ($currentUser && ! $isOwnProfile) {
            $isFriend = DB::table('friends')->where(function ($q) use ($currentUser, $userprofile) {
                $q->where('user_id_one', $currentUser->id)->where('user_id_two', $userprofile->id);
            })->orWhere(function ($q) use ($currentUser, $userprofile) {
                $q->where('user_id_two', $currentUser->id)->where('user_id_one', $userprofile->id);
            })->exists();
            $requestPending = DB::table('friend_requests')->where('user_id_one', $currentUser->id)->where('user_id_two', $userprofile->id)->exists();
            //$receivedRequest = DB::table("friend_requests")->where("user_id_one", $userprofile->id)->where("user_id_two", $currentUser->id)->exists();
            $incomingRequest = DB::table('friend_requests')->where('user_id_one', $userprofile->id)->where('user_id_two', $currentUser->id)->first();
            if ($incomingRequest) {
                $receivedRequest = true;
                $incomingFriendRequestId = $incomingRequest->id;
            }
            $maySendFriendInvitation = ! $isFriend && ! $requestPending && ! $receivedRequest;
        }
        $friendIds = DB::table('friends')->where('user_id_one', $profileId)->pluck('user_id_two')->merge(DB::table('friends')->where('user_id_two', $profileId)->pluck('user_id_one'));
        $friendCount = $friendIds->count();
        $followersCount = DB::table('followers')->where('user_id_two', $profileId)->count();
        $followingsCount = DB::table('followers')->where('user_id_one', $profileId)->count();
        $isFollowing = $currentUser && !$isOwnProfile && DB::table('followers')->where('user_id_one', $currentUser->id)->where('user_id_two', $profileId)->exists();
        $profilefriends = DB::table('users')->select('id', 'username', 'blurb', 'last_activity')->whereIn('id', $friendIds)->get()->map(function ($u) {
            $offlineThreshold = now()->subMinutes(1);
            $u->is_online = $u->last_activity && \Carbon\Carbon::parse($u->last_activity)->gte($offlineThreshold);
            return $u;
        })->sortByDesc('is_online')->take(9);
        $ratingTotals = DB::table('rates')->select('asset_id')->selectRaw('SUM(CASE WHEN rate_type = 1 THEN 1 ELSE 0 END) as likes_count')->selectRaw('SUM(CASE WHEN rate_type = 2 THEN 1 ELSE 0 END) as dislikes_count')->selectRaw('COUNT(*) as ratings_count')->groupBy('asset_id');
        $games = Asset::where('creator_id', $profileId)->places()->notGhosted()->select('assets.*')->selectRaw('COALESCE(rating_totals.likes_count, 0) as likes_count')->selectRaw('COALESCE(rating_totals.dislikes_count, 0) as dislikes_count')->selectRaw('COALESCE(rating_totals.ratings_count, 0) as ratings_count')->leftJoinSub($ratingTotals, 'rating_totals', function ($join) {
            $join->on('rating_totals.asset_id', '=', 'assets.id');
        })->with('creator')->withCount('gamePlayers')->get();
        $badges = DB::table('user_lunarix_badges')->where('user_id', $profileId)->pluck('badge_id');
        $badgeCount = $badges->count();
        $wornAssets = $userprofile->wornAssets()->notGhosted()->with('creator')->get();
        $totalPlaceVisits = $games->sum('visits');
        $forumPostCount = DB::table('forum_thread_posts')->where('author_id', $profileId)->count();
        $recentCollectibles = Inventory::where('user_id', $profileId)->whereHas('asset', function ($q) {
                $q->where(function ($q2) {
                    $q2->where('is_limited', true)->orWhere('is_limited_unique', true);
                });
            })->with('asset')->orderByDesc('obtained_at')->get()->unique('asset_id')->take(6)->values();
        return view('user', ['currentUser' => $currentUser, 'userprofile' => $userprofile, 'games' => $games, 'maySendFriendInvitation' => $maySendFriendInvitation, 'incomingFriendRequestId' => $incomingFriendRequestId, 'friendCount' => $friendCount, 'followersCount' => $followersCount, 'followingsCount' => $followingsCount, 'isFollowing' => $isFollowing, 'profilefriends' => $profilefriends, 'isFriend' => $isFriend, 'requestPending' => $requestPending, 'receivedRequest' => $receivedRequest, 'isOwnProfile' => $isOwnProfile, 'badges' => $badges,  'wornAssets' => $wornAssets, 'badgeCount' => $badgeCount, 'totalPlaceVisits' => $totalPlaceVisits, 'forumPostCount' => $forumPostCount, 'recentCollectibles' => $recentCollectibles, 'title' => $userprofile->username.' - Lunarix']);
    }
}
