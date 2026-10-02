<?php

namespace App\Services;

use App\Models\Games\GamePlayer;
use App\Models\Games\GameServer;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class GameServerManager
{
    public function stop(GameServer $server): int
    {
        $baseUrl = rtrim((string) env('RCC_GAME_API_URL', 'http://127.0.0.1:3500'), '/');
        $accessKey = (string) env('RCC_ACCESS_KEY');

        if ($accessKey === '') {
            throw new RuntimeException('RCC_ACCESS_KEY is not configured.');
        }

        $response = Http::timeout(30)
            ->withHeaders(['gsa-api-key' => $accessKey])
            ->get($baseUrl.'/gs/stop', ['jobId' => $server->job_id]);

        if (! $response->successful()) {
            throw new RuntimeException($response->json('error') ?: 'RCC refused to stop the server.');
        }

        $playerCount = GamePlayer::where('job_id', $server->job_id)->count();
        GamePlayer::where('job_id', $server->job_id)->delete();
        $server->delete();

        return $playerCount;
    }

    public function forget(GameServer $server): int
    {
        $playerCount = GamePlayer::where('job_id', $server->job_id)->count();
        GamePlayer::where('job_id', $server->job_id)->delete();
        $server->delete();

        return $playerCount;
    }
}
