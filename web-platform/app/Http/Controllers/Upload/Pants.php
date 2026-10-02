<?php
namespace App\Http\Controllers\Upload;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Upload\Concerns\PersistsAssets;
use App\Http\Controllers\Upload\Concerns\ClothingValidation;
use App\Models\Asset;
use App\Helpers\XMLBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Pants extends Controller
{
    use PersistsAssets;
    use ClothingValidation;
    private const ALLOWED_MIMES = ['image/png'];
    private const MAX_KB = 10240;
    public function handle(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), ['itemName' => ['required', 'string', 'max:50'], 'description' => ['nullable', 'string', 'max:1000'], 'pantsItem' => ['required', 'file', 'max:' . self::MAX_KB]]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        $file = $request->file('pantsItem');
        if (!in_array($file->getMimeType(), self::ALLOWED_MIMES, true)) {
            return response()->json(['success' => false, 'errors' => ['pantsItem' => ['File must be a PNG, JPEG, or BMP image.']]], 422);
        }
        if ($templateError = $this->clothingTemplateError($file->getRealPath())) {
            return response()->json(['success' => false, 'errors' => ['pantsItem' => [$templateError]]], 422);
        }
        $name = $request->input('itemName');
        $description = (string) $request->input('description', '');
        $imageBytes = file_get_contents($file->getRealPath());
        $pantsAsset = DB::transaction(function () use ($user, $name, $description, $imageBytes) {
            $imageAsset = $this->reserveAsset($user->id, Asset::TYPE_IMAGE);
            $imageVersion = $this->uploadAssetVersion($imageAsset, $imageBytes);
            $imageAsset = $this->finalizeAsset($imageAsset, $imageVersion, $name, ['description' => $description]);
            $pantsXml = XMLBuilder::buildPants($imageAsset->id, $name);
            $pantsAsset = $this->reserveAsset($user->id, Asset::TYPE_PANTS);
            $pantsVersion = $this->uploadAssetVersion($pantsAsset, $pantsXml);
            $asset = $this->finalizeAsset($pantsAsset, $pantsVersion, $name, ['description' => $description, 'related_to' => $imageAsset->id]);
            $this->addToInventory($user->id, $asset);
        });

        return response()->json(['success' => true], 200);
    }
}