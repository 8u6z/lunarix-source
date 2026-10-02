<?php
namespace App\Http\Controllers\RBXApis\Friends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\User;
use App\Models\UserPrivacy;
use App\Services\DiscordBot;

class SocialControls extends Controller
{
    public function removeFriend(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }
        $targetUserID = $request->input('targetUserID');
        if (!$targetUserID) {
            return response()->json(['success' => false, 'error' => 'Missing targetUserID'], 422);
        }
        DB::table('friends')->where(function ($q) use ($user, $targetUserID) {
            $q->where('user_id_one', $user->id)->where('user_id_two', $targetUserID);
        })->orWhere(function ($q) use ($user, $targetUserID) {
            $q->where('user_id_two', $user->id)->where('user_id_one', $targetUserID);
        })->delete();
        return response()->json(['success' => true]);
    }

    public function addFriend(Request $request, DiscordBot $discord)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }
        $targetUserID = $request->input('targetUserID');
        if (!$targetUserID) {
            return response()->json(['success' => false, 'error' => 'Missing targetUserID'], 422);
        }
        if ($user->id == $targetUserID) {
            return response()->json(['success' => false, 'error' => 'You cannot friend yourself'], 422);
        }
        $alreadyFriends = DB::table('friends')->where(function ($q) use ($user, $targetUserID) {
                $q->where('user_id_one', $user->id)->where('user_id_two', $targetUserID);
            })->orWhere(function ($q) use ($user, $targetUserID) {
                $q->where('user_id_two', $user->id)->where('user_id_one', $targetUserID);
            })->exists();
        if ($alreadyFriends) {
            return response()->json(['success' => false, 'error' => 'Already friends'], 422);
        }
        $existingRequest = DB::table('friend_requests')->where(function ($q) use ($user, $targetUserID) {
                $q->where('user_id_one', $user->id)->where('user_id_two', $targetUserID);
            })->orWhere(function ($q) use ($user, $targetUserID) {
                $q->where('user_id_one', $targetUserID)->where('user_id_two', $user->id);
            })->exists();
        if ($existingRequest) {
            return response()->json(['success' => false, 'error' => 'Friend request already exists'], 422);
        }
        DB::table('friend_requests')->insert(['user_id_one' => $user->id, 'user_id_two' => $targetUserID, 'created_at' => now(), 'updated_at' => now()]);
        $target = User::find($targetUserID);
        $notificationsEnabled = UserPrivacy::where('user_id', $targetUserID)->value('discord_notifications') ?? true;
        if ($target?->discord_id && $notificationsEnabled) {
            try {
                $discord->sendDm((string) $target->discord_id, $user->username.' sent you a friend request on Lunarix. '.url('/users/'.$user->id.'/profile'));
            } catch (\Throwable $e) {
                report($e);
            }
        }
        return response()->json(['success' => true]);
    }

    public function requestFriendship(Request $request, DiscordBot $discord): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $recipientUserId = (int) ($request->input('recipientUserId') ?? $request->query('recipientUserId') ?? 0);
        if ($recipientUserId <= 0 || $recipientUserId === (int) $user->id) {
            return response()->json(['success' => false, 'message' => 'Invalid recipientUserId'], 400);
        }

        $recipient = User::find($recipientUserId);
        if (!$recipient) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $alreadyFriends = DB::table('friends')->where(function ($q) use ($user, $recipientUserId) {
                $q->where('user_id_one', $user->id)->where('user_id_two', $recipientUserId);
            })->orWhere(function ($q) use ($user, $recipientUserId) {
                $q->where('user_id_two', $user->id)->where('user_id_one', $recipientUserId);
            })->exists();
        if ($alreadyFriends) {
            return response()->json(['success' => true, 'message' => 'Already friends', 'friendshipStatus' => 'Friends', 'areFriends' => true, 'isFriends' => true]);
        }

        $incomingRequest = DB::table('friend_requests')
            ->where('user_id_one', $recipientUserId)
            ->where('user_id_two', $user->id)
            ->first();

        if ($incomingRequest) {
            DB::transaction(function () use ($user, $recipientUserId) {
                $exists = DB::table('friends')->where(function ($q) use ($user, $recipientUserId) {
                        $q->where('user_id_one', $user->id)->where('user_id_two', $recipientUserId);
                    })->orWhere(function ($q) use ($user, $recipientUserId) {
                        $q->where('user_id_one', $recipientUserId)->where('user_id_two', $user->id);
                    })->exists();

                if (!$exists) {
                    DB::table('friends')->insert(['user_id_one' => $recipientUserId, 'user_id_two' => $user->id, 'created_at' => now(), 'updated_at' => now()]);
                }

                DB::table('friend_requests')
                    ->where('user_id_one', $recipientUserId)
                    ->where('user_id_two', $user->id)
                    ->delete();
            });

            return response()->json(['success' => true, 'message' => 'Success', 'friendshipStatus' => 'Friends']);
        }

        $existingRequest = DB::table('friend_requests')
            ->where('user_id_one', $user->id)
            ->where('user_id_two', $recipientUserId)
            ->exists();

        if (!$existingRequest) {
            DB::table('friend_requests')->insert(['user_id_one' => $user->id, 'user_id_two' => $recipientUserId, 'created_at' => now(), 'updated_at' => now()]);

            $notificationsEnabled = UserPrivacy::where('user_id', $recipientUserId)->value('discord_notifications') ?? true;
            if ($recipient->discord_id && $notificationsEnabled) {
                try {
                    $discord->sendDm((string) $recipient->discord_id, $user->username.' sent you a friend request on Lunarix. '.url('/users/'.$user->id.'/profile'));
                } catch (\Throwable $e) {
                    report($e);
                }
            }
        }

        return response()->json(['success' => true, 'message' => 'Success', 'friendshipStatus' => 'RequestSent']);
    }

    public function acceptFriendRequest(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false,'error' => 'Unauthorized'], 401);
        }
        $targetUserID = $request->input('targetUserID');
        $invitationID = $request->input('invitationID');
        if (!$targetUserID || !$invitationID) {
            return response()->json(['success' => false, 'error' => 'Missing parameters'], 422);
        }
        $friendRequest = DB::table('friend_requests')->where('user_id_one', $targetUserID)->where('user_id_two', $user->id)->first();
        if (!$friendRequest) {
            return response()->json(['success' => false, 'error' => 'Request not found'], 404);
        }
        if ($friendRequest->user_id_two !== $user->id) {
            return response()->json(['success' => false, 'error' => 'Not allowed'], 403);
        }
        if ((int)$targetUserID !== (int)$friendRequest->user_id_one) {
            return response()->json(['success' => false, 'error' => 'Invalid target user'], 422);
        }
        $exists = DB::table('friends')->where(function ($q) use ($friendRequest) {
            $q->where('user_id_one', $friendRequest->user_id_one)->where('user_id_two', $friendRequest->user_id_two);
        })->orWhere(function ($q) use ($friendRequest) {
            $q->where('user_id_one', $friendRequest->user_id_two)->where('user_id_two', $friendRequest->user_id_one);
        })->exists();
        if (!$exists) {
            DB::table('friends')->insert(['user_id_one' => $friendRequest->user_id_one, 'user_id_two' => $friendRequest->user_id_two, 'created_at' => now(), 'updated_at' => now()]);
        }
        DB::table('friend_requests')->where('user_id_one', $targetUserID)->where('user_id_two', $user->id)->delete();
        return response()->json(['success' => true]);
    }

    public function declineFriendRequest(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false,'error' => 'Unauthorized'], 401);
        }
        $targetUserID = $request->input('targetUserID');
        $invitationID = $request->input('invitationID');
        if (!$targetUserID || !$invitationID) {
            return response()->json(['success' => false, 'error' => 'Missing parameters'], 422);
        }
        $friendRequest = DB::table('friend_requests')->where('user_id_one', $targetUserID)->where('user_id_two', $user->id)->first();
        if (!$friendRequest) {
            return response()->json(['success' => false, 'error' => 'Request not found'], 404);
        }
        if ($friendRequest->user_id_two !== $user->id) {
            return response()->json(['success' => false, 'error' => 'Not allowed'], 403);
        }
        if ((int)$targetUserID !== (int)$friendRequest->user_id_one) {
            return response()->json(['success' => false, 'error' => 'Invalid target user'], 422);
        }
        DB::table('friend_requests')->where('user_id_one', $targetUserID)->where('user_id_two', $user->id)->delete();
        return response()->json(['success' => true]);
    }

    public function followingExists(Request $request): JsonResponse
    {
        $followedUserId = (int) $request->query('userId', 0);
        $followerUserId = (int) $request->query('followerUserId', $request->user()->id ?? 0);
        if ($followedUserId <= 0 || $followerUserId <= 0 || $followedUserId === $followerUserId) {
            return response()->json($this->followingPayload(false));
        }

        $isFollowing = $this->hasFollower($followerUserId, $followedUserId);

        return response()->json($this->followingPayload($isFollowing));
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
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $targetUserId = $this->targetUserId($request);
        if ($targetUserId <= 0) {
            return response()->json(['success' => false, 'message' => 'Missing target user.'], 422);
        }
        if ($targetUserId === (int) $user->id) {
            return response()->json(['success' => false, 'message' => 'You cannot follow yourself.'], 422);
        }
        if (!User::query()->whereKey($targetUserId)->exists()) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }
        DB::table('followers')->updateOrInsert(['user_id_one' => $user->id, 'user_id_two' => $targetUserId], ['created_at' => now(), 'updated_at' => now()]);
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
        DB::table('followers')->where('user_id_one', $user->id)->where('user_id_two', $targetUserId)->delete();
        return response()->json($this->followPayload(false));
    }

    private function targetUserId(Request $request): int
    {
        return (int) ($request->input('targetUserID') ?? $request->input('targetUserId') ?? $request->input('followedUserId') ?? $request->input('userId') ?? $request->query('targetUserID') ?? $request->query('targetUserId') ?? $request->query('followedUserId') ?? $request->query('userId') ?? 0);
    }

    private function isFollowing(int $followerUserId, int $followedUserId): bool
    {
        return $this->hasFollower($followerUserId, $followedUserId);
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

    private function hasFollower(int $followerUserId, int $followedUserId): bool
    {
        return DB::table('followers')->where('user_id_one', $followerUserId)->where('user_id_two', $followedUserId)->exists();
    }

    private function followingPayload(bool $isFollowing): array
    {
        return [
            'success' => true,
            'isFollowing' => $isFollowing,
            'followingExists' => $isFollowing,
        ];
    }

    private function followPayload(bool $isFollowing): array
    {
        return ['success' => true, 'isFollowing' => $isFollowing, 'followingExists' => $isFollowing];
    }
}
