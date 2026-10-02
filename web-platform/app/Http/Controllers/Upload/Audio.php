<?php
namespace App\Http\Controllers\Upload;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Upload\Concerns\PersistsAssets;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Audio extends Controller
{
    use PersistsAssets;
    private const ALLOWED_MIMES = ['audio/mpeg', 'audio/mp3', 'audio/mpeg3', 'audio/x-mpeg-3'];
    private const MAX_KB = 5048;
    public function handle(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), ['itemName' => ['required', 'string', 'max:50'], 'description' => ['nullable', 'string', 'max:1000'], 'audioItem' => ['required', 'file', 'max:' . self::MAX_KB]]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }
        $file = $request->file('audioItem');
        $extension = strtolower($file->getClientOriginalExtension());
        $mime = $file->getMimeType();
        if ($extension !== 'mp3' || !in_array($mime, self::ALLOWED_MIMES, true)) {
            return response()->json(['success' => false, 'errors' => ['audioItem' => ['File must be an MP3 audio file.']]], 422);
        }
        $name = $request->input('itemName');
        $description = (string) $request->input('description', '');
        $audioBytes = file_get_contents($file->getRealPath());
        $audioAsset = $this->storeAsset($user->id, Asset::TYPE_AUDIO, $name, $audioBytes, ['description' => $description]);
        $this->addToInventory($user->id, $audioAsset);
        return response()->json(['success' => true], 200);
    }
}