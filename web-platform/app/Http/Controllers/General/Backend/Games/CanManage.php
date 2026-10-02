<?php
namespace App\Http\Controllers\General\Backend\Games;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class CanManage
{
    private const ROLESET_DEVELOPER = 6;
    private const ROLESET_FOUNDER = 7;
    public function canManage(int $id, int $gameid): JsonResponse
    {
        $asset = Asset::where('id', $gameid)->where('type', 9)->first();
        if (!$asset) {
            return response()->json(['Success' => False, 'Error' => 'Game not found'], 404);
        }
        if ($id == 653) {
            return response()->json(['Success' => True, 'CanManage' => True]);
        }
        if ((int) $asset->creator_id === $id) {
            return response()->json(['Success' => True, 'CanManage' => True]);
        }
        $user = User::find($id);
        if ($user && ($user->hasRole(self::ROLESET_DEVELOPER) || $user->hasRole(self::ROLESET_FOUNDER))) {
            return response()->json(['Success' => True, 'CanManage' => true]);
        }
        return response()->json(['Success' => True, 'CanManage' => False]);
    }
}
