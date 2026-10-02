<?php
namespace App\Http\Controllers\Upload;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Upload\Concerns\PersistsAssets;
use App\Models\Asset;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UpdatePlace extends Controller
{
    use PersistsAssets;
    public function edit($id)
    {
        $place = Asset::findOrFail($id);
        abort_unless($place->isPlace(), 404);
        $this->authorizeOwner($place);
        return view('places.configure', ['place' => $place]);
    }

    public function update(Request $request): JsonResponse
    {
        $user = auth()->user();
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $validated = $request->validate(['id' => ['required', 'integer', 'exists:assets,id'], 'name' => ['required', 'string', 'max:50'], 'description' => ['nullable', 'string', 'max:1000'], 'access' => ['required', 'integer', Rule::in([1, 2, 0])], 'max_players' => ['required', 'integer', 'min:1', 'max:50'], 'can_comment' => ['nullable', 'boolean']]);
        $place = Asset::findOrFail($validated['id']);
        abort_unless($place->isPlace(), 404);
        $this->authorizeOwner($place);
        $place->update(['name' => $validated['name'], 'description' => (string) ($validated['description'] ?? ''), 'access' => (int) $validated['access'], 'max_players' => (int) $validated['max_players'], 'can_comment' => (bool) ($validated['can_comment'] ?? false)]);
        return response()->json(['success' => true, 'placeId' => $place->id]);
    }

    public function uploadFile(Request $request): JsonResponse
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $validated = $request->validate(['id' => ['required', 'integer', 'exists:assets,id'], 'placeItem' => ['required', 'file', 'max:51200']]);
        $place = Asset::findOrFail($validated['id']);
        abort_unless($place->isPlace(), 404);
        $this->authorizeOwner($place);
        $file = $request->file('placeItem');
        $contents = file_get_contents($file->getRealPath());
        if (!is_string($contents) || $contents === '') {
            return response()->json(['success' => false, 'message' => 'That file could not be read. Please try again.'], 422);
        }
        if (!$this->isValidRbxl($contents)) {
            return response()->json(['success' => false, 'message' => 'Please upload a valid .rbxl file.'], 422);
        }
        $version = $this->uploadAssetVersion($place, $contents);
        $place->update(['current_version_id' => $version->id]);
        DB::table('asset_renders')->where('asset_id', $place->id)->whereIn('render_type', ['place', 'place_square'])->delete();
        return response()->json(['success' => true, 'placeId' => $place->id, 'versionId' => $version->id]);
    }

    private function isValidRbxl(string $contents): bool
    {
        $binaryMagic = "<roblox!\x89\xff\r\n\x1a\n";
        if (str_starts_with($contents, $binaryMagic)) {
            return true;
        }
        $head = ltrim(substr($contents, 0, 512));
        if (str_starts_with($head, '<roblox') && !str_starts_with($head, '<roblox!')) {
            return true;
        }
        return false;
    }

    public function uploadThumbnail(Request $request): JsonResponse
    {
        $user = auth()->user();
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $validated = $request->validate(['id' => ['required', 'integer', 'exists:assets,id'], 'thumbnail_large' => ['nullable', 'required_without:thumbnail_square', 'file', 'mimes:png', 'max:10240'], 'thumbnail_square' => ['nullable', 'required_without:thumbnail_large', 'file', 'mimes:png', 'max:10240']]);
        $place = Asset::findOrFail($validated['id']);
        abort_unless($place->isPlace(), 404);
        $this->authorizeOwner($place);
        $renders = [];
        foreach (['thumbnail_large' => 'place', 'thumbnail_square' => 'place_square'] as $field => $renderType) {
            if (! $request->hasFile($field)) {
                continue;
            }
            $contents = file_get_contents($request->file($field)->getRealPath());
            if (! is_string($contents) || $contents === '') {
                return response()->json(['success' => false, 'message' => 'That file could not be read. Please try again.'], 422);
            }
            if (! $this->isValidPng($contents)) {
                return response()->json(['success' => false, 'message' => 'Please upload a valid PNG image.'], 422);
            }
            $renders[$renderType] = $this->storeThumbnailRender($place, $contents, $renderType);
        }
        return response()->json(['success' => true, 'placeId' => $place->id, 'renders' => $renders]);
    }

    private function storeThumbnailRender(Asset $place, string $contents, string $renderType): string
    {
        $path = "asset/{$place->id}/" . bin2hex(random_bytes(8)) . '.png';
        Storage::disk('renders')->put($path, $contents);
        DB::table('asset_renders')->insert(['asset_id' => $place->id, 'asset_type' => $place->type, 'render_path' => $path, 'render_type' => $renderType, 'is_place_thumbnail' => true, 'created_at' => now()]);
        $approvalColumn = $renderType === 'place_square' ? 'thumbnail_square_approval' : 'thumbnail_approval';
        $place->update([$approvalColumn => 0]);
        return $path;
    }

    private function isValidPng(string $contents): bool
    {
        $pngMagic = "\x89PNG\r\n\x1a\n";
        if (! str_starts_with($contents, $pngMagic)) {
            return false;
        }
        $imageInfo = @getimagesizefromstring($contents);
        return $imageInfo !== false && $imageInfo[2] === IMAGETYPE_PNG;
    }

    private function authorizeOwner(Asset $place): void
    {
        abort_unless($place->creator_id === auth()->id(), 403, 'You do not have permission to configure this place.');
    }
}