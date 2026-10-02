<?php
namespace App\Http\Controllers\Admin;
use App\Models\Games\GameServer;
use App\Services\AdminAudit;
use App\Services\GameServerManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameServers
{
    public function index(): View
    {
        $servers = GameServer::query()->with(['place.creator', 'players.user'])->withCount('players')->orderByDesc('created_at')->get();
        return view('admin.dev.game-servers', compact('servers'));
    }

    public function stop(Request $request, GameServer $server, GameServerManager $manager): RedirectResponse
    {
        try {
            $playersRemoved = $manager->stop($server);
        } catch (\Throwable $exception) {
            report($exception);
            return back()->withErrors(['server' => 'The server could not be stopped: '.$exception->getMessage()]);
        }
        AdminAudit::record('game_server.stopped', ['job_id' => $server->job_id, 'place_id' => $server->asset_id, 'players_removed' => $playersRemoved], $server->place?->creator_id, $request->user()->id);
        return back()->with('success', 'Game server '.$server->job_id.' was stopped.');
    }

    public function forget(Request $request, GameServer $server, GameServerManager $manager): RedirectResponse
    {
        $jobId = $server->job_id;
        $placeId = $server->asset_id;
        $creatorId = $server->place?->creator_id;
        $playersRemoved = $manager->forget($server);
        AdminAudit::record('game_server.record_forgotten', ['job_id' => $jobId, 'place_id' => $placeId, 'players_removed' => $playersRemoved], $creatorId, $request->user()->id);
        return back()->with('success', 'The stale server record was removed.');
    }
}
