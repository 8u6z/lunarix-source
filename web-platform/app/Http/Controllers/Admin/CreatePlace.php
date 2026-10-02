<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Upload\PersistsAssets;
use App\Models\Asset;
use App\Models\User;
use App\Services\AdminAudit;
use App\Services\AssetRenderQueue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CreatePlace
{
    use PersistsAssets;
    private const MAX_UPLOAD_KB = 51200;
    public function index(): View
    {
        return view('admin.dev.create-place');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'creator_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
            'file' => ['required', 'file', 'max:'.self::MAX_UPLOAD_KB],
            'access' => ['required', 'integer', Rule::in([0, 1, 2])],
            'max_players' => ['required', 'integer', 'min:1', 'max:100'],
            'can_comment' => ['nullable', 'boolean'],
        ]);
        $file = $request->file('file');
        $contents = $this->validatedPlaceContents($file->getRealPath(), $file->getClientOriginalExtension());
        $creator = User::query()->findOrFail((int) $validated['creator_id']);
        $place = DB::transaction(function () use ($request, $validated, $contents, $creator, $file) {
            $place = $this->reserveAsset($creator->id, Asset::TYPE_PLACE);
            $version = $this->uploadAssetVersion($place, $contents);
            $universeId = DB::table('universes')->insertGetId(['current_version_id' => $version->id, 'asset_id' => $place->id, 'created_at' => now(), 'updated_at' => now()]);
            $place = $this->finalizeAsset($place, $version, $validated['name'], ['description' => (string) ($validated['description'] ?? ''), 'access' => (int) $validated['access'], 'can_comment' => $request->boolean('can_comment'), 'universe_id' => $universeId]);
            $place->update(['approval' => Asset::APPROVAL_APPROVED, 'max_players' => (int) $validated['max_players'], 'onsale' => false, 'robux' => 0]);
            $this->addToInventory($creator->id, $place);
            AdminAudit::record('game.created', [
                'game_id' => $place->id,
                'universe_id' => $universeId,
                'version_id' => $version->id,
                'creator_id' => $creator->id,
                'name' => $place->name,
                'access' => $place->access,
                'max_players' => $place->max_players,
                'source_filename' => $file->getClientOriginalName(),
            ], $creator->id, $request->user()->id);
            return $place->fresh();
        });
        $renderQueue = app(AssetRenderQueue::class);
        $normalQueued = $renderQueue->queue($place);
        $squareQueued = $renderQueue->queue($place, false, true);
        $renderMessage = $normalQueued || $squareQueued ? ' Thumbnail renders queued.' : '';
        return redirect()->route('admin.dev.create-place')->with('success', "Place “{$place->name}” created as game {$place->id} for {$creator->username} ({$creator->id}).{$renderMessage}")->with('created_place_id', $place->id);
    }

    private function validatedPlaceContents(string $path, string $extension): string
    {
        $extension = strtolower($extension);
        if (! in_array($extension, ['rbxl', 'rbxlx'], true)) {
            throw ValidationException::withMessages(['file' => 'Places require an .rbxl or .rbxlx file.']);
        }
        $contents = file_get_contents($path);
        if (! is_string($contents) || $contents === '') {
            throw ValidationException::withMessages(['file' => 'The uploaded place is empty or could not be read.']);
        }
        $header = strtolower(substr($contents, 0, 4096));
        $isBinaryPlace = $extension === 'rbxl' && str_starts_with($header, '<roblox!');
        $isXmlPlace = $extension === 'rbxlx' && str_contains($header, '<roblox');
        if (! $isBinaryPlace && ! $isXmlPlace) {
            throw ValidationException::withMessages(['file' => 'The uploaded file does not appear to be a valid Roblox place.']);
        }
        return $contents;
    }
}
