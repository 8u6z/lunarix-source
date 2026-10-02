<?php
namespace App\Http\Controllers\RBXApis;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSocial
{
    public function followingExists(Request $request): JsonResponse
    {
        $followedUserId = (int) $request->query('userId', 0);
        $followerUserId = (int) $request->query('followerUserId', $request->user()->id ?? 0);
        if ($followedUserId <= 0 || $followerUserId <= 0 || $followedUserId === $followerUserId) {
            return response()->json($this->followingPayload(false));
        }
        return response()->json($this->followingPayload($this->isFollowing($followerUserId, $followedUserId)));
    }

    public function friendshipCount(Request $request): JsonResponse
    {
        $userId = (int) $request->query('userId', $request->user()->id ?? 0);
        if ($userId <= 0) {
            return response()->json(['success' => false, 'message' => 'Missing userId'], 422);
        }
        $count = DB::table('friends')->where('user_id_one', $userId)->orWhere('user_id_two', $userId)->count();
        return response()->json(['success' => true, 'count' => $count, 'friendshipCount' => $count, 'userId' => $userId]);
    }

    public function follow(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $targetUserId = $this->targetUserId($request);
        if ($targetUserId <= 0) {
            return response()->json(['success' => false, 'message' => 'Missing target user.'], 422);
        }
        if ($targetUserId === (int) $user->id) {
            return response()->json(['success' => false, 'message' => 'You cannot follow yourself.'], 422);
        }
        if (! User::query()->whereKey($targetUserId)->exists()) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }
        if ($this->areFriends((int) $user->id, $targetUserId) || $this->hasOutgoingRequest((int) $user->id, $targetUserId)) {
            return response()->json($this->followPayload(true));
        }
        DB::table('friend_requests')->updateOrInsert(['user_id_one' => $user->id, 'user_id_two' => $targetUserId], ['created_at' => now(), 'updated_at' => now()]);
        return response()->json($this->followPayload(true));
    }

    public function unfollow(Request $request): JsonResponse
    {
        $user = $request->user();
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $targetUserId = $this->targetUserId($request);
        if ($targetUserId <= 0) {
            return response()->json(['success' => false, 'message' => 'Missing target user.'], 422);
        }
        DB::table('friend_requests')->where('user_id_one', $user->id)->where('user_id_two', $targetUserId)->delete();
        return response()->json($this->followPayload($this->areFriends((int) $user->id, $targetUserId)));
    }

    private function targetUserId(Request $request): int
    {
        return (int) ($request->input('targetUserID') ?? $request->input('targetUserId') ?? $request->input('followedUserId') ?? $request->input('userId') ?? $request->query('targetUserID') ?? $request->query('targetUserId') ?? $request->query('followedUserId') ?? $request->query('userId') ?? 0);
    }

    private function isFollowing(int $followerUserId, int $followedUserId): bool
    {
        return $this->areFriends($followerUserId, $followedUserId) || $this->hasOutgoingRequest($followerUserId, $followedUserId);
    }

    private function areFriends(int $firstUserId, int $secondUserId): bool
    {
        return DB::table('friends')->where(function ($query) use ($firstUserId, $secondUserId) {
                $query->where('user_id_one', $firstUserId)->where('user_id_two', $secondUserId);
            })->orWhere(function ($query) use ($firstUserId, $secondUserId) {
                $query->where('user_id_one', $secondUserId)->where('user_id_two', $firstUserId);
            })->exists();
    }

    private function hasOutgoingRequest(int $followerUserId, int $followedUserId): bool
    {
        return DB::table('friend_requests')->where('user_id_one', $followerUserId)->where('user_id_two', $followedUserId)->exists();
    }

    private function followingPayload(bool $isFollowing): array
    {
        return ['success' => true, 'isFollowing' => $isFollowing, 'followingExists' => $isFollowing];
    }

    private function followPayload(bool $isFollowing): array
    {
        return ['success' => true, 'isFollowing' => $isFollowing, 'followingExists' => $isFollowing];
    }
}
