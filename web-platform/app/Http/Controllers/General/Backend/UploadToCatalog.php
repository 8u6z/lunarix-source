<?php
namespace App\Http\Controllers\General\Backend;
use App\Http\Controllers\Upload\Audio;
use App\Http\Controllers\Upload\Decal;
use App\Http\Controllers\Upload\Pants;
use App\Http\Controllers\Upload\Shirt;
use App\Http\Controllers\Upload\TShirt;
use App\Models\Asset;
use Illuminate\Http\Request;

class UploadToCatalog
{
    public function uploadToCatalog(Request $request)
    {
        $type = (int) $request->input('type');
        $controller = match ($type) {
            Asset::TYPE_DECAL => Decal::class,
            Asset::TYPE_SHIRT => Shirt::class,
            Asset::TYPE_PANTS => Pants::class,
            Asset::TYPE_AUDIO => Audio::class,
            Asset::TYPE_TSHIRT => TShirt::class,
            default => null
        };
        if ($controller === null) {
            return response()->json(['success' => false, 'errors' => ['type' => ['Unsupported or missing upload type.']]], 422);
        }
        return app($controller)->handle($request);
    }
}
