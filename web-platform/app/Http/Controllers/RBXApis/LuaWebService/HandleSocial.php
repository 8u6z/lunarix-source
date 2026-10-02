<?php
namespace App\Http\Controllers\RBXApis\LuaWebService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class HandleSocial extends Controller
{
    public function handle(Request $request)
    {
        $method = $request->query('method');
        return match ($method) {'IsFriendsWith' => $this->isFriendsWith($request), 'IsInGroup' => $this->isInGroup($request), 'GetGroupRank' => $this->getGroupRank($request), 'GetGroupRole' => $this->getGroupRole($request), default => response('Invalid method', 400)};
        //return match ($method) {'IsFriendsWith' => $this->isFriendsWith($request), 'IsInGroup' => $this->isInGroup($request), default => response('Invalid method', 400)};
    }

    private function xmlBool(bool $value): Response
    {
        $val = $value ? 'true' : 'false';
        return response("<Value Type=\"boolean\">{$val}</Value>", 200, ['Content-Type' => 'text/plain']);
    }

    private function xmlInt(int $value): Response
    {
        return response("<Value Type=\"integer\">{$value}</Value>", 200, ['Content-Type' => 'text/plain']);
    }

    private function isFriendsWith(Request $request): Response
    {
        $playerId = $request->query('playerid');
        $userId = $request->query('userid');
        if (!$playerId || !$userId) {
            return $this->xmlBool(false);
        }
        $isFriends = DB::table('friends')->where(function ($q) use ($playerId, $userId) {
                $q->where('user_id_one', $playerId)->where('user_id_two', $userId);
            })->orWhere(function ($q) use ($playerId, $userId) {
                $q->where('user_id_one', $userId)->where('user_id_two', $playerId);
            })->exists();
        return $this->xmlBool($isFriends);
    }

    private function isInGroup(Request $request): Response
    {
        $playerId = $request->query('playerid');
        $groupId = $request->query('groupid');
        if (!$playerId || !$groupId) {
            return $this->xmlBool(false);
        }
        if ((int)$groupId !== 1200769) {
            return $this->xmlBool(false);
        }
        $user = DB::table('users')->where('id', $playerId)->first();
        if (!$user) {
            return $this->xmlBool(false);
        }
        $inGroup = isset($user->roleset) && (int)$user->roleset >= 1;
        return $this->xmlBool($inGroup);
    }

    private function getGroupRank(Request $request): Response
    {
        $playerId = $request->query('playerid');
        $groupId = $request->query('groupid');
        if (!$playerId || !$groupId) {
            return $this->xmlInt(0);
        }
        if ((int)$groupId !== 1) {
            return $this->xmlInt(0);
        }
        $user = DB::table('users')->where('id', $playerId)->first();
        if (!$user || !isset($user->roleset) || (int)$user->roleset < 1) {
            return $this->xmlInt(0);
        }
        return $this->xmlInt(100);
    }

    private function getGroupRole(Request $request): Response
    {
        $playerId = $request->query('playerid');
        $groupId = $request->query('groupid');
        if (!$playerId || !$groupId) {
            return response('Guest', 200, ['Content-Type' => 'text/plain']);
        }
        if ((int)$groupId !== 1) {
            return response('Guest', 200, ['Content-Type' => 'text/plain']);
        }
        $user = DB::table('users')->where('id', $playerId)->first();
        if (!$user || !isset($user->roleset) || (int)$user->roleset < 1) {
            return response('Guest', 200, ['Content-Type' => 'text/plain']);
        }
        return response('Member', 200, ['Content-Type' => 'text/plain']);
    }
}