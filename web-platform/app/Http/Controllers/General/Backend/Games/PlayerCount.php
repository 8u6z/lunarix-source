<?php
namespace App\Http\Controllers\General\Backend\Games;
use App\Models\Games\GamePlayer;
use Illuminate\Http\JsonResponse;

class PlayerCount
{
    public function playerCount(): JsonResponse
    {
        return response()->json(['count' => GamePlayer::count()]);
    }
}
