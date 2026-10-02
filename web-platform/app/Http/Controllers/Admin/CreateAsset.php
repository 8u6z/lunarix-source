<?php
namespace App\Http\Controllers\Admin;
use App\Helpers\XMLBuilder;
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

class CreateAsset
{
    use PersistsAssets;
    private const MAX_UPLOAD_KB = 51200;
    private const TYPES = ['hat' => Asset::TYPE_HAT, 'face' => Asset::TYPE_FACE, 'gear' => Asset::TYPE_GEAR, 'mesh' => Asset::TYPE_MESH, 'image' => Asset::TYPE_IMAGE];
    public function index(): View
    {
        return view('admin.assets.create');
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
        return redirect()->route('admin.assets.create')->with('success', $result->getTypeName().' “'.$result->name.'” created as asset '.$result->id.'.'.($renderQueued ? ' Thumbnail render queued.' : ''));
    }

    private function validatedFileContents(string $path, string $extension, ?string $mime, string $type): string
    {
        $extension = strtolower($extension);
        if ($type === 'face' || $type === 'image') {
            $allowedMimes = ['image/png', 'image/jpeg'];
            if (! in_array($extension, ['png', 'jpg', 'jpeg'], true) || ! in_array($mime, $allowedMimes, true) || @getimagesize($path) === false) {
                throw ValidationException::withMessages(['file' => ucfirst($type).' assets require a valid PNG or JPEG image.']);
            }
            $contents = file_get_contents($path);
            if (! is_string($contents) || $contents === '') {
                throw ValidationException::withMessages(['file' => 'The uploaded file is empty or could not be read.']);
            }
            return $contents;
        }
        if ($type === 'mesh') {
            if ($extension !== 'mesh') {
                throw ValidationException::withMessages(['file' => 'Mesh assets require a .mesh file.']);
            }
            $contents = file_get_contents($path);
            if (! is_string($contents) || $contents === '') {
                throw ValidationException::withMessages(['file' => 'The uploaded file is empty or could not be read.']);
            }
            if (! str_starts_with($contents, 'version ')) {
                throw ValidationException::withMessages(['file' => 'The uploaded file does not appear to be a valid Roblox mesh.']);
            }
            return $contents;
        }
        if ($extension !== 'lrxm' && $extension !== 'rbxm' && $extension !== 'rbxmx') {
            throw ValidationException::withMessages(['file' => ucfirst($type).' assets require an .rbxm file.']);
        }
        $contents = file_get_contents($path);
        if (! is_string($contents) || $contents === '') {
            throw ValidationException::withMessages(['file' => 'The uploaded file is empty or could not be read.']);
        }
        if (! str_contains(strtolower(substr($contents, 0, 1024)), '<roblox')) {
            throw ValidationException::withMessages(['file' => 'The uploaded file does not appear to be a valid Roblox model.']);
        }
        return $contents;
    }
}
