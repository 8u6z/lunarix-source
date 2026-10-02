<?php
namespace App\Http\Controllers\RBXApis\Friends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FriendService extends Controller
{
    public function areFriends(Request $request): Response
    {
        $userId = (int) ($request->query('userId') ?? $request->query('playerId') ?? $request->query('userid') ?? 0);
        $otherUserIds = collect([
                ...$this->repeatedQueryValues($request, 'otherUserIds'),
                ...$this->repeatedQueryValues($request, 'otherUserIds[]'),
                ...$this->repeatedQueryValues($request, 'otherUserId'),
                ...$this->repeatedQueryValues($request, 'userIds'),
            ])
            ->flatMap(fn ($id) => explode(',', (string) $id))
            ->map(fn ($id) => (int) $id)
            ->filter(fn ($id) => $id > 0 && $id !== $userId)
            ->unique()
            ->values();

        if ($userId <= 0 || $otherUserIds->isEmpty()) {
            return response('[]', 200, ['Content-Type' => 'text/plain']);
        }

        $friendIds = DB::table('friends')
            ->where(function ($query) use ($userId, $otherUserIds) {
                $query->where('user_id_one', $userId)
                    ->whereIn('user_id_two', $otherUserIds);
            })
            ->orWhere(function ($query) use ($userId, $otherUserIds) {
                $query->where('user_id_two', $userId)
                    ->whereIn('user_id_one', $otherUserIds);
            })
            ->get()
            ->map(fn ($friend) => (int) $friend->user_id_one === $userId ? (int) $friend->user_id_two : (int) $friend->user_id_one)
            ->unique()
            ->values();

        return response('[' . $friendIds->implode(',') . ']', 200, ['Content-Type' => 'text/plain']);
    }

    private function repeatedQueryValues(Request $request, string $key): array
    {
        $values = [];
        foreach (explode('&', (string) $request->server('QUERY_STRING', '')) as $part) {
            if ($part === '') {
                continue;
            }

            [$name, $value] = array_pad(explode('=', $part, 2), 2, '');
            if (rawurldecode($name) === $key) {
                $values[] = rawurldecode($value);
            }
        }

        return $values;
    }
}
