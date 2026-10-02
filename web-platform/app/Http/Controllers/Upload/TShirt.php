<?php
namespace App\Http\Controllers\Upload;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Upload\Concerns\PersistsAssets;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TShirt extends Controller
{
    use PersistsAssets;
    private const ALLOWED_MIMES = ['image/png'];
    private const MAX_KB = 4096;
    public function handle(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), ['itemName' => ['required', 'string', 'max:50'], 'description' => ['nullable', 'string', 'max:1000'], 'tshirtItem' => ['required', 'file', 'max:' . self::MAX_KB]]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        $file = $request->file('tshirtItem');
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = $file->getMimeType();
        if ($extension !== 'png' || !in_array($mime, self::ALLOWED_MIMES, true)) {
            return response()->json(['success' => false, 'errors' => ['tshirtItem' => ['File must be a PNG file.']]], 422);
        }
        $name = $request->input('itemName');
        $description = (string) $request->input('description', '');
        $tshirtBytes = file_get_contents($file->getRealPath());
        $tshirtAsset = $this->storeAsset($user->id, Asset::TYPE_TSHIRT, $name, $tshirtBytes, ['description' => $description]);
        $this->addToInventory($user->id, $tshirtAsset);
        return response()->json(['success' => true], 200);
    }
}