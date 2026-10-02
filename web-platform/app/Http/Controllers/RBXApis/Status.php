<?php
namespace App\Http\Controllers\RBXApis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Presence;
use Carbon\Carbon;

class Status
{
    public function getPresence(Request $request)
    {
        $userIds = $request->input('userIds', []);
        if (!is_array($userIds)) {
            return response()->json(["errors" => [["message" => "userIds must be an array"]]], 400);
        }
        $users = DB::table('users')->whereIn('id', $userIds)->select('id', 'last_activity')->get()->keyBy('id');
        $now = Carbon::now();
        $timeoutSeconds = 90;
        $response = [];
        foreach ($userIds as $userId) {
            $user = $users->get($userId);
            $presenceType = Presence::OFFLINE;
            $lastLocation = "Website";
            $placeId = null;
            $rootPlaceId = null;
            $gameId = null;
            $universeId = null;
            if ($user && $user->last_activity) {
                $lastActivity = Carbon::parse($user->last_activity);
                $diff = $now->diffInSeconds($lastActivity);
                if ($diff <= $timeoutSeconds) {
                    $presenceType = Presence::ONLINE;
                } else {
                    $presenceType = Presence::OFFLINE;
                }
            }
            $response[] = ["userPresenceType" => $presenceType, "lastLocation" => $lastLocation, "placeId" => $placeId, "rootPlaceId" => $rootPlaceId, "gameId" => $gameId, "universeId" => $universeId, "userId" => (int) $userId];
        }
        return response()->json(["userPresences" => $response]);
    }
}