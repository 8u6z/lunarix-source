<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Upload\PersistsAssets;
use App\Models\Asset;
use App\Models\User;
use App\Services\AssetRenderQueue;
use App\Services\AdminAudit;
use App\Support\XMLBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MigrateAsset
{
    use PersistsAssets;
    private const MAX_UPLOAD_KB = 51200;
    private const TYPES = ['hat' => Asset::TYPE_HAT, 'image' => Asset::TYPE_IMAGE, 'mesh' => Asset::TYPE_MESH, 'face' => Asset::TYPE_FACE];
    private const ROBLOX_TYPE_MAP = [8 => Asset::TYPE_HAT, 41 => Asset::TYPE_HAT, 18 => Asset::TYPE_FACE, 19 => Asset::TYPE_GEAR];
    public function index(): View
    {
        return view('admin.assets.migrator');
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['type' => ['required', Rule::in(array_keys(self::TYPES))], 'name' => ['required', 'string', 'max:50'], 'description' => ['nullable', 'string', 'max:1000'], 'file' => ['required', 'file', 'max:'.self::MAX_UPLOAD_KB], 'onsale' => ['nullable', 'boolean'], 'price' => ['required', 'integer', 'min:0', 'max:2147483647'], 'is_limited' => ['nullable', 'boolean'], 'limited_quantity' => ['nullable', 'required_if:is_limited,1', 'integer', 'min:1', 'max:2147483647'], 'is_limited_unique' => ['nullable', 'boolean']]);
        $file = $request->file('file');
        $typeKey = $validated['type'];
        $contents = $this->validatedFileContents($file->getRealPath(), $file->getClientOriginalExtension(), $file->getMimeType(), $typeKey);
        $creator = User::findOrFail(1);
        $description = (string) ($validated['description'] ?? '');
        $onSale = $request->boolean('onsale');
        $price = (int) $validated['price'];
        $isLimited = $request->boolean('is_limited');
        $isLimitedUnique = $request->boolean('is_limited_unique');
        $limitedQuantity = $isLimited ? (int) $validated['limited_quantity'] : null;
        if ($isLimitedUnique && ! $isLimited) {
            throw ValidationException::withMessages(['is_limited_unique' => 'Unique items must also be limited.']);
        }
        $result = DB::transaction(function () use ($request, $validated, $contents, $creator, $description, $onSale, $price, $typeKey, $isLimited, $isLimitedUnique, $limitedQuantity) {
            $relatedImageId = null;
            if ($typeKey === 'face') {
                $imageAsset = $this->reserveAsset($creator->id, Asset::TYPE_IMAGE);
                $imageVersion = $this->uploadAssetVersion($imageAsset, $contents);
                $imageAsset = $this->finalizeAsset($imageAsset, $imageVersion, $validated['name'], ['description' => $description]);
                $relatedImageId = $imageAsset->id;
                $faceXml = XMLBuilder::buildFace($imageAsset->id, $validated['name']);
                $asset = $this->reserveAsset($creator->id, Asset::TYPE_FACE);
                $version = $this->uploadAssetVersion($asset, $faceXml);
                $asset = $this->finalizeAsset($asset, $version, $validated['name'], ['description' => $description, 'related_to' => $imageAsset->id]);
                $this->addToInventory($creator->id, $asset);
            } else {
                $asset = $this->storeAsset($creator->id, self::TYPES[$typeKey], $validated['name'], $contents, ['description' => $description]);
            }
            $asset->update(['onsale' => $onSale, 'robux' => $onSale ? $price : 0, 'is_limited' => $isLimited, 'is_limited_unique' => $isLimitedUnique, 'limited_quantity' => $limitedQuantity]);
            AdminAudit::record('asset.created', ['asset_id' => $asset->id, 'asset_type' => $asset->getTypeName(), 'name' => $asset->name, 'creator_id' => $creator->id, 'on_sale' => $onSale, 'price' => $onSale ? $price : 0, 'image_asset_id' => $relatedImageId, 'limited' => $isLimited, 'limited_quantity' => $limitedQuantity, 'unique' => $isLimitedUnique], $creator->id, $request->user()->id);
            return $asset;
        });
        $renderQueued = app(AssetRenderQueue::class)->queue($result);
        return redirect()->route('admin.assets.migrator')->with('success', $result->getTypeName().' "'.$result->name.'" created as asset '.$result->id.'.'.($renderQueued ? ' Thumbnail render queued.' : ''));
    }

    public function migrateFromRoblox(Request $request): RedirectResponse
    {
        $validated = $request->validate(['url' => ['required', 'string', 'max:500']]);
        $creator = User::findOrFail(1);
        $robloxAssetId = $this->extractRobloxAssetId($validated['url']);
        $details = $this->fetchRobloxAssetDetails($robloxAssetId);
        $assetType = self::ROBLOX_TYPE_MAP[$details['AssetTypeId'] ?? null] ?? null;
        abort_if($assetType === null, 422, 'Unsupported or unrecognized Roblox AssetTypeId: '.($details['AssetTypeId'] ?? 'unknown'));
        $rawXml = $this->downloadRobloxAsset($robloxAssetId);
        if (!str_contains(strtolower(substr($rawXml, 0, 1024)), '<roblox')) {
            throw ValidationException::withMessages(['url' => 'Downloaded Roblox asset is not a valid model.']);
        }
        $name = (string) ($details['Name'] ?? ('Asset '.$robloxAssetId));
        $description = (string) ($details['Description'] ?? '');
        $result = DB::transaction(function () use ($rawXml, $creator, $assetType, $name, $description, $robloxAssetId, $request) {
            $xml = $this->replaceReferencedRobloxAssets($rawXml, $creator->id);
            $xml = $this->convertAccessoryClassToHat($xml);
            $asset = $this->storeAsset($creator->id, $assetType, $name, $xml, ['description' => $description]);
            AdminAudit::record('asset.migrated_from_roblox', ['asset_id' => $asset->id, 'asset_type' => $asset->getTypeName(), 'name' => $asset->name, 'creator_id' => $creator->id, 'source_roblox_asset_id' => $robloxAssetId], $creator->id, $request->user()->id);
            return $asset;
        });
        $renderQueued = app(AssetRenderQueue::class)->queue($result);
        return redirect()->route('admin.assets.migrator')->with('success', $result->getTypeName().' "'.$result->name.'" migrated as asset '.$result->id.'.'.($renderQueued ? ' Thumbnail render queued.' : ''));
    }

    private function extractRobloxAssetId(string $input): int
    {
        $input = trim($input);
        if (ctype_digit($input)) {
            return (int) $input;
        }
        if (preg_match('#/(?:catalog|library)/(\d+)#i', $input, $m)) {
            return (int) $m[1];
        }
        if (preg_match('#[?&]id=(\d+)#i', $input, $m)) {
            return (int) $m[1];
        }
        if (preg_match('#(\d+)#', $input, $m)) {
            return (int) $m[1];
        }
        throw ValidationException::withMessages(['url' => 'Could not determine a Roblox asset ID from that URL.']);
    }

    private function fetchRobloxAssetDetails(int $assetId): array
    {
        $response = Http::timeout(15)->get("https://economy.roblox.com/v2/assets/{$assetId}/details");
        abort_unless($response->successful(), 502, 'Failed to fetch asset details from Roblox.');
        $data = $response->json();
        abort_if(!is_array($data) || !isset($data['AssetTypeId']), 502, 'Unexpected response from Roblox economy API.');
        return $data;
    }

    private function downloadRobloxAsset(int $assetId, int $version = 1): string
    {
        $response = Http::timeout(20)->withHeaders(['Cookie' => '.ROBLOSECURITY=' . env('ROBLOX_SECURITY_COOKIE')])->get('https://assetdelivery.roblox.com/v1/asset', ['id' => $assetId, 'version' => $version]);
        abort_unless($response->successful(), 502, "Failed to download Roblox asset {$assetId}.");
        $contents = $response->body();
        abort_if($contents === '', 502, "Roblox asset {$assetId} returned empty content.");
        return $contents;
    }

    private function extractReferencedRobloxAssets(string $xml): array
    {
        preg_match_all('#<Content\s+name="([^"]+)">\s*<url>([^<]+)</url>\s*</Content>#i', $xml, $matches, PREG_SET_ORDER);
        $refs = [];
        foreach ($matches as $m) {
            $url = trim($m[2]);
            if (! preg_match('#^(?:https?://(?:www\.)?roblox\.com/[Aa]sset/?\??|rbxassetid://)#i', $url)) {
                continue;
            }
            if (! preg_match('#(\d+)\s*$#', $url, $idMatch)) {
                continue;
            }
            $refs[] = ['tag' => strtolower($m[1]), 'url' => $m[2], 'id' => (int) $idMatch[1]];
        }
        return $refs;
    }

    private function replaceReferencedRobloxAssets(string $xml, int $creatorId): string
    {
        foreach ($this->extractReferencedRobloxAssets($xml) as $ref) {
            $contents = $this->downloadRobloxAsset($ref['id']);
            if ($ref['tag'] === 'meshid') {
                if (!str_starts_with($contents, 'version ')) {
                    throw ValidationException::withMessages(['url' => "Referenced mesh asset {$ref['id']} is not a valid mesh."]);
                }
                $newAsset = $this->storeAsset($creatorId, Asset::TYPE_MESH, 'Mesh '.$ref['id'], $contents, []);
            } elseif ($ref['tag'] === 'textureid') {
                if (@getimagesizefromstring($contents) === false) {
                    throw ValidationException::withMessages(['url' => "Referenced texture asset {$ref['id']} is not a valid image."]);
                }
                $newAsset = $this->storeAsset($creatorId, Asset::TYPE_IMAGE, 'Texture '.$ref['id'], $contents, []);
            } else {
                continue;
            }
            $newUrl = rtrim(config('app.roblox_asset_base_url', 'https://lunarix.lol/asset'), '/').'?id='.$newAsset->id;
            $xml = str_replace($ref['url'], $newUrl, $xml);
        }
        return $xml;
    }

    private function validatedFileContents(string $path, string $extension, ?string $mime, string $type): string
    {
        $extension = strtolower($extension);
        if ($type === 'face' || $type === 'image') {
            $allowedMimes = ['image/png', 'image/jpeg'];
            if (!in_array($extension, ['png', 'jpg', 'jpeg'], true) || !in_array($mime, $allowedMimes, true) || @getimagesize($path) === false) {
                throw ValidationException::withMessages(['file' => ucfirst($type).' assets require a valid PNG or JPEG image.']);
            }
            $contents = file_get_contents($path);
            if (!is_string($contents) || $contents === '') {
                throw ValidationException::withMessages(['file' => 'The uploaded file is empty or could not be read.']);
            }
            return $contents;
        }
        if ($type === 'mesh') {
            if ($extension !== 'mesh') {
                throw ValidationException::withMessages(['file' => 'Mesh assets require a .mesh file.']);
            }
            $contents = file_get_contents($path);
            if (!is_string($contents) || $contents === '') {
                throw ValidationException::withMessages(['file' => 'The uploaded file is empty or could not be read.']);
            }
            if (!str_starts_with($contents, 'version ')) {
                throw ValidationException::withMessages(['file' => 'The uploaded file does not appear to be a valid Roblox mesh.']);
            }
            return $contents;
        }
        if ($extension !== 'rbxm') {
            throw ValidationException::withMessages(['file' => ucfirst($type).' assets require an .rbxm file.']);
        }
        $contents = file_get_contents($path);
        if (!is_string($contents) || $contents === '') {
            throw ValidationException::withMessages(['file' => 'The uploaded file is empty or could not be read.']);
        }
        if (!str_contains(strtolower(substr($contents, 0, 1024)), '<roblox')) {
            throw ValidationException::withMessages(['file' => 'The uploaded file does not appear to be a valid Roblox model.']);
        }
        return $contents;
    }

    private function convertAccessoryClassToHat(string $xml): string
    {
        return preg_replace('#<Item\s+class="Accessory"(\s+referent="[^"]*")>#i', '<Item class="Hat"$1>', $xml);
    }
}