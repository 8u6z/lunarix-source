<?php
namespace App\Http\Controllers\General\Backend\Games;
use App\Models\Asset;
use App\Models\Games\GamePlayer;
use App\Models\Games\GameServer;
use App\Models\User;
use Illuminate\Http\Request;

class GameInstances
{
    public function getGameInstances(Request $request)
    {
        // port from aftwld
        $placeId = (int) $request->query('placeId');
        $startIndex = (int) $request->query('startindex', 0);
        $place = Asset::where('id', $placeId)->where('type', 9)->first();
        if (! $place) {
            return response('Could not find Place.');
        }
        $hasPermission = false;
        $user = auth()->user();
        if ($user && $place->creator_id == $user->id) {
            $hasPermission = true;
        }
        $result = ['PlaceId' => $place->id, 'ShowShutdownAllButton' => $hasPermission, 'Collection' => [], 'TotalCollectionSize' => 0];
        $baseQuery = GameServer::where('asset_id', $place->id)->where('status', 2);
        $result['TotalCollectionSize'] = (clone $baseQuery)->count();
        $servers = (clone $baseQuery)->orderByDesc(GamePlayer::selectRaw('count(*)')->whereColumn('game_presences.job_id', 'game_servers.job_id'))->offset($startIndex)->limit(10)->get();
        $isRoblox = str_contains($request->header('User-Agent', ''), 'ROBLOX');
        foreach ($servers as $server) {
            $players = GamePlayer::where('job_id', $server->job_id)->get();
            $playerList = [];
            $userIds = $players->pluck('user_id')->filter(fn ($id) => $id > 0)->all();
            $usersById = User::whereIn('id', $userIds)->pluck('username', 'id');
            foreach ($players as $player) {
                $userId = (int) $player->user_id;
                $isGuest = $userId <= 0;
                $playerName = $isGuest ? 'Guest User' : ($usersById[$userId] ?? 'Unknown');
                $thumbnailUrl = $isGuest ? '/img/guest.png' : "/Thumbs/Avatar.ashx?userId={$player->user_id}&x=75&y=75";
                $playerList[] = ['Id' => $player->user_id, 'Username' => $playerName, 'Thumbnail' => ['rowId' => 0, 'rowHash' => null, 'rowTypeId' => 0, 'Url' => $thumbnailUrl, 'IsFinal' => true]];
            }
            $joinScript = ! $isRoblox ? "Roblox.GameLauncher.joinGameInstance({$server->asset_id}, '{$server->job_id}');" : "window.location.href = '/games/start?placeid={$server->asset_id}&gameInstanceId={$server->job_id}';";
            $result['Collection'][] = ['Capacity' => $server->capacity, 'Ping' => $server->ping ?? 0, 'Fps' => $server->fps ?? 60, 'ShowSlowGameMessage' => false, 'Guid' => $server->job_id, 'PlaceId' => $server->asset_id, 'CurrentPlayers' => $playerList, 'UserCanJoin' => false, 'ShowShutdownButton' => $hasPermission, 'JoinScript' => $joinScript];
        }
        return response()->json($result);
    }
}
