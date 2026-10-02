<?php
namespace App\Http\Controllers\RBXApis\Friends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;

class Friends extends Controller
{
    public function getFriends(Request $request)
    {
        $userId = $request->query('userId');
        $currentPage = (int) $request->query('currentPage', 0);
        $pageSize = (int) $request->query('pageSize', 18);
        $friendsType = $request->query('friendsType', 'AllFriends');
        abort_if(!$userId, 400);
        $user = DB::table('users')->where('id', $userId)->first();
        abort_if(!$user, 404);
        $authController = app(AuthController::class);
        $currentUser = $authController->getAuthenticatedUser($request);
        if ($friendsType === 'FriendRequests') {
            abort_if(!$currentUser, 401);
            abort_if($currentUser->id != $userId, 403);
            $requesterIds = DB::table('friend_requests')->where('user_id_two', $userId)->pluck('user_id_one');
            $targetIds = $requesterIds;
        } elseif ($friendsType === 'Following') {
            $targetIds = DB::table('followers')->where('user_id_one', $userId)->pluck('user_id_two')->unique()->values();
        } elseif ($friendsType === 'Followers') {
            $targetIds = DB::table('followers')->where('user_id_two', $userId)->pluck('user_id_one')->unique()->values();
        } else {
            $targetIds = DB::table('friends')->where('user_id_one', $userId)->pluck('user_id_two')->merge(DB::table('friends')->where('user_id_two', $userId)->pluck('user_id_one'))->unique()->values();
        }
        $totalFriends = $targetIds->count();
        $totalPages = $pageSize > 0 ? (int) ceil($totalFriends / $pageSize) : 1;
        $offset = $currentPage;
        $pagedIds = $targetIds->slice($offset, $pageSize)->values();
        $renderMap = DB::table('user_renders')->whereIn('user_id', $pagedIds)->where('render_type', 'avatar')->orderByDesc('created_at')->get()->keyBy('user_id');
        $offlineThreshold = now()->subMinutes(1);
        $followingIds = $currentUser ? DB::table('followers')->where('user_id_one', $currentUser->id)->pluck('user_id_two')->merge(DB::table('friends')->where('user_id_one', $currentUser->id)->pluck('user_id_two'))->merge(DB::table('friends')->where('user_id_two', $currentUser->id)->pluck('user_id_one'))->unique() : collect();
        $friends = DB::table('users')->select('id', 'username', 'last_activity')->whereIn('id', $pagedIds)->get()->map(function ($u) use ($offlineThreshold, $friendsType, $renderMap, $followingIds) {
            $isOnline = $u->last_activity && \Carbon\Carbon::parse($u->last_activity)->gte($offlineThreshold);
            $lastSeen = $u->last_activity ? \Carbon\Carbon::parse($u->last_activity)->format('n/j/Y g:i:s A') : 'Unknown';
            return [
                'UserId' => $u->id,
                'AbsoluteURL' => '/users/' . $u->id . '/profile',
                'Username' => $u->username,
                'AvatarUri' => '/Thumbs/Avatar.ashx?userId=' . $u->id,
                'AvatarFinal' => true,
                'OnlineStatus' => [
                    'LocationOrLastSeen' => $isOnline ? 'Online' : $lastSeen,
                    'ImageUrl' => $isOnline ? '/img/online.png' : '/img/offline.png',
                    'AlternateText' => $isOnline ? $u->username . ' is online.' : $u->username . ' is offline (last seen at ' . $lastSeen . ').',
                ],
                'Thumbnail' => [
                    'Final' => true,
                    'Url' => '/Thumbs/Avatar.ashx?userId=' . $u->id,
                    'RetryUrl' => null,
                ],
                'InvitationId' => 0,
                'LastLocation' => '',
                'PlaceId' => null,
                'AbsolutePlaceURL' => null,
                'IsOnline' => $isOnline,
                'InGame' => false,
                'InStudio' => false,
                'IsFollowed' => $followingIds->contains($u->id),
                'ItemVisible' => true,
                'FriendshipStatus' => $friendsType === 'FriendRequests' ? 2 : 3,
                'IsDeleted' => false,
            ];
        });
        return response()->json(['UserId' => (int) $userId, 'TotalFriends' => $totalFriends, 'CurrentPage' => $currentPage, 'PageSize' => $pageSize, 'TotalPages' => $totalPages, 'FriendsType' => $friendsType, 'Friends' => $friends]);
    }
}
