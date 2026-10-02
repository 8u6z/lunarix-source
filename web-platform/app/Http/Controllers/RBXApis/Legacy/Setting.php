<?php
namespace App\Http\Controllers\RBXApis\Legacy;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Setting extends Controller
{
    public function SettingLegacy($setting)
    {
        $file = "{$setting}";
        if (!Storage::disk('public')->exists($file)) {
            abort(404);
        }
        $contents = Storage::disk('public')->get($file);
        return response($contents, 200)->header('Content-Type', 'application/json');
    }
}
