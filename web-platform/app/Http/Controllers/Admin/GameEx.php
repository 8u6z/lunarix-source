<?php
namespace App\Http\Controllers\Admin;
use App\Models\Games\GameServer;
use App\Services\AdminAudit;
use App\Services\GameServerManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameEx
{
    public function index(): View
    {
        $servers = GameServer::query()->with(['place.creator', 'players.user'])->withCount('players')->orderByDesc('created_at')->get();
        return view('admin.dev.gameex', compact('servers'));
    }
}
