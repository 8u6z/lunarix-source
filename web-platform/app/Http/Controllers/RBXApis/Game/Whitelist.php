<?php
namespace App\Http\Controllers\RBXApis\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Whitelist extends Controller
{
    public function getAllowedMd5Hashes(Request $request)
    {
        return response()->json(['data' => ['7f254dd4d44510ff19311aaf1c140402']]);
    }
    

    public function getAllowedSecurityVersions(Request $request)
    {
        return response()->json(['data' => ['1.3.0pcplayer', '1.2.0.4', 'INTERNALiosapp', 'INTERNALandroidapp']]);
    }

    public function getAllowedSecurityKeys(Request $request)
    {
        return response()->json(true);
    }
}
