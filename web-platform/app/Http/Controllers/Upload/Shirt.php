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

class Shirt extends Controller
{
    use PersistsAssets;
    use ClothingValidation;
    private const ALLOWED_MIMES = ['image/png'];
    private const MAX_KB = 10240;
    public function handle(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), ['itemName' => ['required', 'string', 'max:50'], 'description' => ['nullable', 'string', 'max:1000'], 'shirtItem' => ['required', 'file', 'max:' . self::MAX_KB]]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        $file = $request->file('shirtItem');
        if (!in_array($file->getMimeType(), self::ALLOWED_MIMES, true)) {
            return response()->json(['success' => false, 'errors' => ['shirtItem' => ['File must be a PNG image.']]], 422);
        }
        if ($templateError = $this->clothingTemplateError($file->getRealPath())) {
            return response()->json(['success' => false, 'errors' => ['shirtItem' => [$templateError]]], 422);
        }
        $name = $request->input('itemName');
        $description = (string) $request->input('description', '');
        $imageBytes = file_get_contents($file->getRealPath());
        $shirtAsset = DB::transaction(function () use ($user, $name, $description, $imageBytes) {
            $imageAsset = $this->reserveAsset($user->id, Asset::TYPE_IMAGE);
            $imageVersion = $this->uploadAssetVersion($imageAsset, $imageBytes);
            $imageAsset = $this->finalizeAsset($imageAsset, $imageVersion, $name, ['description' => $description]);
            $shirtXml = XMLBuilder::buildShirt($imageAsset->id, $name);
            $shirtAsset = $this->reserveAsset($user->id, Asset::TYPE_SHIRT);
            $shirtVersion = $this->uploadAssetVersion($shirtAsset, $shirtXml);
            $asset = $this->finalizeAsset($shirtAsset, $shirtVersion, $name, ['description' => $description, 'related_to' => $imageAsset->id]);
            $this->addToInventory($user->id, $asset);
        });
        return response()->json(['success' => true], 200);
    }
}