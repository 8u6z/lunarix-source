<?php
namespace App\Http\Controllers\RBXApis\Universe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidateJoin
{
    public function validate(Request $request)
    {
        $originPlaceId = $request->query('originPlaceId');
        $destinationPlaceId = $request->query('destinationPlaceId');
        if (!ctype_digit((string) $originPlaceId) || !ctype_digit((string) $destinationPlaceId)) {
            return response('true', 200)->header('Content-Type', 'text/plain');
        }
        $originPlace = DB::table('assets')->where('id', (int) $originPlaceId)->first();
        if (!$originPlace) {
            return response('true', 200)->header('Content-Type', 'text/plain');
        }
        $destinationPlace = DB::table('assets')->where('id', (int) $destinationPlaceId)->first();
        if (!$destinationPlace) {
            return response('true', 200)->header('Content-Type', 'text/plain');
        }
        $originUniverse = DB::table('universes')->where('asset_id', $originPlace->id)->first();
        $destinationUniverse = DB::table('universes')->where('asset_id', $destinationPlace->id)->first();
        if (!$originUniverse || !$destinationUniverse) {
            return response('true', 200)->header('Content-Type', 'text/plain');
        }
        return response('true', 200)->header('Content-Type', 'text/plain');
    }
}