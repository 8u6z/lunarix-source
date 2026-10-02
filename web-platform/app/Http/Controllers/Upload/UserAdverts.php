<?php
namespace App\Http\Controllers\Upload;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Upload\Concerns\PersistsAssets;

class UserAdverts
{
    use PersistsAssets;
    private const DIMENSIONS_TO_TYPE = ['728x90' => 1, '160x600' => 2, '300x250' => 3];
    private const ALLOWED_TARGET_TYPES = [Asset::TYPE_PLACE, Asset::TYPE_TSHIRT, Asset::TYPE_SHIRT, Asset::TYPE_PANTS];
    public function store(Request $request)
    {
        $request->validate(['targetID' => ['required', 'integer'], 'adItem' => ['required', 'file', 'mimes:png'], 'itemName' => ['required', 'string', 'max:100']]);
        $user = $request->user();
        $target = Asset::where('id', $request->input('targetID'))->where('creator_id', $user->id)->whereIn('type', self::ALLOWED_TARGET_TYPES)->first();
        if (!$target) {
            return response()->json(['success' => false, 'message' => 'Invalid or unowned target.'], 422);
        }
        $file = $request->file('adItem');
        [$width, $height] = getimagesize($file->getRealPath());
        $key = "{$width}x{$height}";
        if (!isset(self::DIMENSIONS_TO_TYPE[$key])) {
            return response()->json(['success' => false, 'message' => 'Image must be exactly 728x90, 160x600, or 300x250.'], 422);
        }
        $contents = file_get_contents($file->getRealPath());
        $asset = $this->storeAsset($user->id, Asset::TYPE_IMAGE, $request->input('itemName'), $contents, ['access' => 0]);
        $userAd = DB::table('user_ads')->insertGetId(['target_id' => $target->id, 'type' => self::DIMENSIONS_TO_TYPE[$key], 'image_id' => $asset->id, 'impressions' => 0, 'clicks' => 0, 'bid_amount' => 0, 'impressions_last_run' => 0, 'clicks_last_run' => 0, 'bid_amount_last_run' => 0, 'created_at' => now(), 'updated_at' => now()]);
        return response()->json(['success' => true, 'ad_id' => $userAd, 'asset_id' => $asset->id]);
    }
}