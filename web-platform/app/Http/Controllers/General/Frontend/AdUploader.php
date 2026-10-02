<?php
namespace App\Http\Controllers\General\Frontend;
use App\Models\Asset;
use Illuminate\Http\Request;

class AdUploader
{
    private const ALLOWED_TARGET_TYPES = [Asset::TYPE_PLACE, Asset::TYPE_TSHIRT, Asset::TYPE_SHIRT, Asset::TYPE_PANTS];
    public function show(Request $request)
    {
        $targetID = $request->query('targetID');
        if (!$targetID || !ctype_digit((string) $targetID)) {
            abort(404);
        }
        $target = Asset::where('id', $targetID)->where('creator_id', $request->user()->id)->whereIn('type', self::ALLOWED_TARGET_TYPES)->first();
        if (!$target) {
            abort(404);
        }
        return view('advertise.view', ['target' => $target]);
    }
}