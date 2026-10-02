<?php
namespace App\Http\Controllers\RBXApis\RCC;
use App\Models\Games\GameServer;
use App\Traits\AccessKey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Analytics
{
    use AccessKey;
    public function report(Request $request): JsonResponse
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(['jobid' => 'required|string', 'fps' => 'required|numeric|min:0', 'ping' => 'required|numeric|min:0']);
        $server = GameServer::where('job_id', $validated['jobid'])->first();
        if (! $server) {
            return response()->json(['error' => 'Game server not found'], 404);
        }
        $server->update(['fps' => (int) round($validated['fps']), 'ping' => (int) round($validated['ping']), 'last_heartbeat_at' => now()]);
        return response()->json(['success' => true]);
    }
}