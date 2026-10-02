<?php
namespace App\Http\Controllers\RBXApis\Game;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Traits\Ticket;
use App\Jobs\Game;

class PlaceLauncher extends Controller
{
    use Ticket;
    public function handle(Request $request): JsonResponse
    {
        if (!auth()->user()) {
            return response()->json(['status' => 12, 'message' => 'You are not authorized to join'], 403);
        }
        $requestType = $request->query('request');
        $placeId = $request->query('placeId');
        $isPartyLeader = $request->boolean('isPartyLeader');
        $gender = $request->query('gender', '');
        $isTeleport = $request->boolean('isTeleport');
        return match ($requestType) {'RequestGame' => $this->requestGame($placeId, $gender, $isTeleport), 'RequestGameJob' => $this->requestGameJob($request), 'CheckGameJobStatus' => $this->checkGameJobStatus($request), default => $this->error('Unknown request type')};
    }

    private function requestGame(?string $placeId, string $gender, bool $isTeleport): JsonResponse
    {
        if (!$placeId) {
            return $this->error('Missing placeId');
        }
        if (Str::isUuid($placeId)) {
            return $this->requestSpecificServer($placeId);
        }
        $place = DB::table('assets')->where('id', $placeId)->first();
        if (!$place) {
            return $this->error('Place not found', 404);
        }
        if ($place->ghosted) {
            return $this->error('Place is unavailable');
        }
        if ((int) $place->access === 0) {
            return $this->error('Place is private', 403);
        }
        if ((int) $place->approval === 2) {
            return $this->error('Unauthorized', 403);
        }
        $server = DB::table('game_servers')->where('asset_id', $placeId)->where('status', 2)->whereRaw('(select count(*) from game_presences where game_presences.job_id = game_servers.job_id) < game_servers.capacity')->orderByRaw('(select count(*) from game_presences where game_presences.job_id = game_servers.job_id) desc')->first();

        if ($server) {
            return response()->json([
                'jobId' => $server->job_id,
                'status' => $server->status,
                'joinScriptUrl' => url('/Game/Join.ashx?jobId=' . $server->job_id),
                'authenticationUrl' => url('/Login/Negotiate.ashx'),
                'authenticationTicket' => $this->generateAuthTicket(auth()->id()),
                'message' => 'Server found (' . $server->job_id . ')',
                'joinScript' => '',
            ]);
        }
        $lockKey = "place_launch_pending:{$placeId}";
        $jobId = Cache::get($lockKey);
        if (!$jobId) {
            $jobId = Str::uuid()->toString();
            $port = rand(40000, 50000);
            $soapPort = rand(51000, 61000);
            Game::dispatch($jobId, (string) $placeId, $port, $soapPort, (int) $place->creator_id);
            Cache::put($lockKey, $jobId, now()->addSeconds(20));
        }
        return response()->json(['status' => 1, 'jobId' => $jobId, 'message' => 'Server is starting'], 200);
    }

    private function requestSpecificServer(string $jobId): JsonResponse
    {
        $server = DB::table('game_servers')->where('job_id', $jobId)->first();
        if (!$server) {
            return $this->error('Game job not found', 404);
        }
        $place = DB::table('assets')->where('id', $server->asset_id)->first();
        if (!$place) {
            return $this->error('Place not found', 404);
        }
        if ($place->ghosted) {
            return $this->error('Place is unavailable');
        }
        if ((int) $place->access === 0) {
            return $this->error('Place is private', 403);
        }
        if ((int) $place->approval === 2) {
            return $this->error('Unauthorized', 403);
        }
        if ((int) $server->status !== 2) {
            return response()->json(['status' => 1, 'jobId' => $server->job_id, 'message' => 'Server is starting'], 200);
        }
        $playerCount = DB::table('game_presences')->where('job_id', $jobId)->count();
        if ($playerCount >= (int) $server->capacity) {
            return $this->error('Server is full', 6);
        }
        return response()->json([
            'jobId' => $server->job_id,
            'status' => $server->status,
            'joinScriptUrl' => url('/Game/Join.ashx?jobId=' . $server->job_id),
            'authenticationUrl' => url('/Login/Negotiate.ashx'),
            'authenticationTicket' => $this->generateAuthTicket(auth()->id()),
            'message' => 'Server found (' . $server->job_id . ')',
            'joinScript' => '',
        ]);
    }

    private function requestGameJob(Request $request): JsonResponse
    {
        $jobId = $request->query('gameJobId') ?? $request->query('jobId');
        $placeId = $request->query('placeId');
        if (!$jobId || !$placeId) {
            return $this->error('Missing gameJobId or placeId');
        }
        $place = DB::table('assets')->where('id', $placeId)->first();
        if (!$place) {
            return $this->error('Place not found', 404);
        }
        if ($place->ghosted) {
            return $this->error('Place is unavailable');
        }
        if ((int) $place->access === 0) {
            return $this->error('Place is private', 403);
        }
        if ((int) $place->approval === 2) {
            return $this->error('Unauthorized', 403);
        }
        $server = DB::table('game_servers')->where('job_id', $jobId)->where('universe_id', $place->universe_id)->first();
        if (!$server) {
            return $this->error('Game job not found', 404);
        }
        $playerCount = DB::table('game_presences')->where('job_id', $jobId)->count();
        if ($playerCount >= (int) $server->capacity) {
            return $this->error('Server is full', 6);
        }
        return response()->json(['jobId' => $server->job_id, 'status' => $server->status, 'joinScriptUrl' => url('/Game/Join.ashx?jobId=' . $server->job_id), 'authenticationUrl' => url('/Login/Negotiate.ashx'), 'authenticationTicket' => $this->generateAuthTicket(auth()->id()), 'message' => 'Server found (' . $server->job_id . ')', 'joinScript' => '']);
    }

    private function checkGameJobStatus(Request $request): JsonResponse
    {
        $jobId = $request->query('gameJobId') ?? $request->query('jobId');
        if (!$jobId) {
            return $this->error('Missing gameJobId');
        }
        $server = DB::table('game_servers')->where('job_id', $jobId)->first();
        if (!$server) {
            if (Cache::has("place_launch_job:{$jobId}")) {
                return response()->json(['jobId' => $jobId, 'status' => 1, 'message' => 'Server is starting']);
            }
            return response()->json(['jobId' => $jobId, 'status' => 1, 'message' => 'Server is still on queue']);
        }
        if ((int) $server->status !== 2) {
            return response()->json(['jobId' => $server->job_id, 'status' => 1, 'message' => 'Server is starting']);
        }
        return response()->json([
            'jobId' => $server->job_id,
            'status' => 2,
            'joinScriptUrl' => url('/Game/Join.ashx?jobId=' . $server->job_id),
            'authenticationUrl' => url('/Login/Negotiate.ashx'),
            'authenticationTicket' => $this->generateAuthTicket(auth()->id()),
            'message' => 'Server found (' . $server->job_id . ')',
            'joinScript' => '',
        ]);
    }

    private function error(string $message, int $status = 400): JsonResponse
    {
        return response()->json(['status' => $status, 'message' => $message], $status);
    }
}