<?php
namespace App\Http\Controllers\RBXApis\RCC;
use App\Http\Controllers\Controller;
use App\Models\Games\GameServer;
use App\Services\GameServerManager;
use App\Traits\AccessKey;
use Illuminate\Http\Request;

class CloseGameServer extends Controller
{
    use AccessKey;
    public function closeGameServer(Request $request, GameServerManager $manager)
    {
        if (! $this->isRCC($request)) {
            return response()->json(['error' => 'Invalid access key'], 403);
        }
        $jobId = $request->query('jobid');
        if (! $jobId) {
            return response()->json(['success' => false, 'error' => 'Missing jobId'], 400);
        }
        $server = GameServer::where('job_id', $jobId)->first();
        if (! $server) {
            return response()->json(['success' => false, 'error' => 'Job not found'], 404);
        }
        try {
            $playerCount = $manager->stop($server);
        } catch (\Throwable $e) {
            \Log::error('rcc close request failed', ['jobId' => $jobId, 'error' => $e->getMessage()]);

            return response()->json(['success' => false, 'error' => $e->getMessage()], 502);
        }
        \Log::info('game server closed', ['jobId' => $jobId, 'playersRemoved' => $playerCount]);
        return response()->json(['success' => true, 'jobId' => $jobId, 'playersRemoved' => $playerCount]);
    }
}
