<?php
namespace App\Http\Controllers\Admin;
use App\Models\Asset;
use App\Models\Games\GameServer;
use App\Services\AdminAudit;
use App\Services\GameServerManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GameManagement
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $games = Asset::query()->places()->with('creator:id,username');
        if ($query !== '') {
            $games->where(function ($builder) use ($query) {
                if (ctype_digit($query)) {
                    $builder->orWhere('id', (int) $query);
                }
                $builder->orWhereRaw('LOWER(name) LIKE ?', ['%'.strtolower($query).'%']);
            })->orderByRaw('CASE WHEN LOWER(name) = ? THEN 0 ELSE 1 END', [strtolower($query)]);
        }

        return view('admin.games.find', ['query' => $query, 'games' => $games->orderBy('id')->paginate(50)->withQueryString()]);
    }

    public function edit(Asset $game): View
    {
        abort_unless($game->isPlace(), 404);
        $game->load('creator:id,username');
        return view('admin.games.edit', compact('game'));
    }

    public function update(Request $request, Asset $game): RedirectResponse
    {
        abort_unless($game->isPlace(), 404);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
            'max_players' => ['required', 'integer', 'min:1', 'max:100'],
            'access' => ['required', 'integer', 'min:0', 'max:2'],
            'can_comment' => ['nullable', 'boolean'],
            'ghosted' => ['nullable', 'boolean'],
            'staff_picks' => ['nullable', 'boolean'],
            'lunarix_classic' => ['nullable', 'boolean'],
        ]);
        $before = $game->only(['name', 'description', 'max_players', 'access', 'can_comment', 'ghosted', 'staff_picks', 'lunarix_classic']);
        $game->update(['name' => $validated['name'], 'description' => (string) ($validated['description'] ?? ''), 'max_players' => (int) $validated['max_players'], 'access' => (int) $validated['access'], 'can_comment' => $request->boolean('can_comment'), 'ghosted' => $request->boolean('ghosted'), 'staff_picks' => $request->boolean('staff_picks'), 'lunarix_classic' => $request->boolean('lunarix_classic')]);
        AdminAudit::record('game.updated', ['game_id' => $game->id, 'before' => $before, 'after' => $game->fresh()->only(array_keys($before))], $game->creator_id, $request->user()->id);
        return redirect()->route('admin.games.edit', $game)->with('success', 'Game information updated.');
    }

    public function deleteContent(Request $request, Asset $game, GameServerManager $serverManager): RedirectResponse
    {
        abort_unless($game->isPlace(), 404);
        $validated = $request->validate(['moderation_action' => ['required', Rule::in(['hide', 'delete'])]]);
        $action = $validated['moderation_action'];
        DB::transaction(function () use ($request, $game, $action) {
            $lockedGame = Asset::query()->lockForUpdate()->findOrFail($game->id);
            abort_unless($lockedGame->isPlace(), 404);
            $before = $lockedGame->only(['name', 'description', 'access', 'can_comment', 'onsale', 'approval', 'ghosted']);
            $updates = ['access' => 0, 'can_comment' => false, 'onsale' => false, 'ghosted' => true, 'approval' => $action === 'hide' ? Asset::APPROVAL_PENDING : Asset::APPROVAL_REJECTED];
            if ($action === 'delete') {
                $updates['name'] = '[ Content Deleted ]';
                $updates['description'] = '[ Content Deleted ]';
            }
            $lockedGame->update($updates);
            AdminAudit::record($action === 'hide' ? 'game.hidden_for_moderation' : 'game.content_deleted', ['game_id' => $lockedGame->id, 'moderation_action' => $action, 'before' => $before, 'after' => $lockedGame->fresh()->only(array_keys($before))], $lockedGame->creator_id, $request->user()->id);
        });
        $stopFailures = [];
        foreach (GameServer::query()->where('asset_id', $game->id)->where('status', '!=', 0)->get() as $server) {
            try {
                $serverManager->stop($server);
            } catch (\Throwable $exception) {
                report($exception);
                $stopFailures[] = $server->job_id;
            }
        }
        $message = $action === 'hide' ? 'The game is hidden while it is pending moderation.' : 'The game was content deleted.';
        $response = redirect()->route('admin.games.edit', $game)->with('success', $message);
        if ($stopFailures !== []) {
            $response->withErrors(['servers' => 'The game is inaccessible, but these RCC jobs could not be stopped automatically: '.implode(', ', $stopFailures).'.']);
        }
        return $response;
    }
}
