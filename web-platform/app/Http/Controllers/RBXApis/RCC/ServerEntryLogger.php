<?php
namespace App\Http\Controllers\RBXApis\RCC;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Games\GamePlayer;
use App\Models\Games\GameServer;
use App\Traits\AccessKey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServerEntryLogger extends Controller
{
    use AccessKey;
    public function userJoin(Request $request): JsonResponse
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(['playerid' => 'required|integer', 'jobid' => 'required|string']);
        if ($validated['playerid'] < 0) {
            return response()->json(['error' => 'Guests cannot be logged'], 200);
        }
        $userExists = DB::table('users')->where('id', $validated['playerid'])->exists();
        if (! $userExists) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $server = GameServer::where('job_id', $validated['jobid'])->first();
        if (! $server) {
            return response()->json(['error' => 'Game server not found'], 404);
        }
        GamePlayer::updateOrCreate(['user_id' => $validated['playerid']], ['job_id' => $server->job_id, 'place_id' => $server->asset_id, 'last_seen_at' => now()]);
        DB::table('users')->where('id', $validated['playerid'])->increment('moons');
        DB::table('assets')->where('id', $server->asset_id)->increment('visits');
        return response()->json(['success' => true]);
    }

    public function userExit(Request $request): JsonResponse
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Invalid access key'], 403);
        }
        $validated = $request->validate(['playerid' => 'required|integer', 'jobid' => 'required|string']);
        GamePlayer::where('user_id', $validated['playerid'])->where('job_id', $validated['jobid'])->delete();
        return response()->json(['success' => true]);
    }
}
