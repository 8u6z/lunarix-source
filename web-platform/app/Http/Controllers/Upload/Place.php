<?php
namespace App\Http\Controllers\Upload;
use App\Http\Controllers\Upload\Concerns\PersistsAssets;
use App\Models\Asset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
class Place extends Controller
{
    use PersistsAssets;
    public function storePlace(Request $request): JsonResponse
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $validated = $request->validate(['name' => ['required', 'string', 'max:50'], 'description' => ['nullable', 'string', 'max:1000'], 'access' => ['required', 'integer', Rule::in([0, 1, 2])], 'max_players' => ['required', 'integer', 'min:1', 'max:100'], 'can_comment' => ['nullable', 'boolean']]);
        if (!Storage::disk('public')->exists('Baseplate.rbxl')) {
            return response()->json(['success' => false, 'message' => 'Please contact the developers.'], 500);
        }
        $contents = Storage::disk('public')->get('Baseplate.rbxl');
        if (!is_string($contents) || $contents === '') {
            return response()->json(['success' => false, 'message' => 'Please contact the developers.'], 500);
        }
        $place = DB::transaction(function () use ($validated, $contents, $user) {
            $place = $this->reserveAsset($user->id, Asset::TYPE_PLACE);
            $version = $this->uploadAssetVersion($place, $contents);
            $universeId = DB::table('universes')->insertGetId(['current_version_id' => $version->id, 'asset_id' => $place->id, 'created_at' => now(), 'updated_at' => now()]);
            $place = $this->finalizeAsset($place, $version, $validated['name'], ['description' => (string) ($validated['description'] ?? ''), 'access' => (int) $validated['access'], 'can_comment' => true, 'universe_id' => $universeId]);
            $place->update(['approval' => Asset::APPROVAL_APPROVED, 'max_players' => (int) $validated['max_players'], 'onsale' => false, 'robux' => 0]);
            $this->addToInventory($user->id, $place);
            $this->assignDefaultThumbnails($place);
            return $place->fresh();
        });
        return response()->json(['success' => true, 'placeId' => $place->id, 'universeId' => $place->universe_id]);
    }

    private function assignDefaultThumbnails(Asset $place): void
    {
        $index = random_int(1, 3);
        foreach (['place' => 'square', 'place_square' => 'thumb'] as $renderType => $folder) {
            $sourcePath = "placeimages/{$folder}/{$index}.png";
            if (!Storage::disk('public')->exists($sourcePath)) {
                continue;
            }
            $contents = Storage::disk('public')->get($sourcePath);
            if (!is_string($contents) || $contents === '') {
                continue;
            }
            $path = "asset/{$place->id}/" . bin2hex(random_bytes(8)) . '.png';
            Storage::disk('renders')->put($path, $contents);
            DB::table('asset_renders')->insert(['asset_id' => $place->id, 'asset_type' => $place->type, 'render_path' => $path, 'render_type' => $renderType, 'is_place_thumbnail' => true, 'created_at' => now()]);
        }
    }
}