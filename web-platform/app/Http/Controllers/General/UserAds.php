<?php
namespace App\Http\Controllers\General;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAds
{
    private const HOUSE_ADS = [
        [
            'title' => 'Get Lunarix Bloxxers Club today!',
            'href'  => '/Upgrades/BloxxersClubMemberships.aspx',
            'images' => [1 => '/img/house-ads/membership_728x90.png', 2 => '/img/house-ads/membership_160x600.png', 3 => '/img/house-ads/membership_300x250.png'],
        ]
    ];
    private const HOUSE_AD_CHANCE = 15;
    private const AD_DIMENSIONS = [
        1 => ['width' => 728, 'height' => 90],
        2 => ['width' => 160, 'height' => 600],
        3 => ['width' => 300, 'height' => 250],
    ];

    public function show(int $type)
    {
        if (!in_array($type, [1, 2, 3])) {
            abort(404);
        }
        $dims = self::AD_DIMENSIONS[$type];
        if (rand(1, 100) <= self::HOUSE_AD_CHANCE) {
            return $this->renderHouseAd($type);
        }
        $ad = $this->pickAd($type);
        if (!$ad) {
            return $this->renderHouseAd($type);
        }
        DB::table('user_ads')->where('id', $ad->id)->decrement('bid_amount', 1);
        DB::table('user_ads')->where('id', $ad->id)->increment('impressions', 1);
        DB::table('user_ads')->where('id', $ad->id)->increment('impressions_last_run', 1);
        $redirectData = base64_encode($ad->id . '|/item-item?id=' . $ad->target_id);
        $imageUrl = '/Thumbs/Asset.ashx?assetId=' . $ad->image_id . '&width=' . $dims['width'] . '&height=' . $dims['height'];
        $redirectUrl = '/userads/redirect?data=' . urlencode($redirectData);
        return view('ad.view', ['imageUrl' => $imageUrl, 'redirectUrl' => $redirectUrl, 'title' => 'Advertisement', 'adId' => $ad->id, 'assetId' => $ad->target_id, 'isHouse' => false, 'width' => $dims['width'], 'height' => $dims['height']]);
    }

    public function redirect(Request $request)
    {
        $data = base64_decode($request->query('data', ''));
        if (!$data || !str_contains($data, '|')) {
            return redirect('/');
        }
        [$adId, $target] = explode('|', $data, 2);
        $adId = (int) $adId;
        $ad = Ad::find($adId);
        if ($ad && $ad->bid_amount > 0) {
            $deduct = min(5, $ad->bid_amount);
            DB::table('user_ads')->where('id', $adId)->decrement('bid_amount', $deduct);
            DB::table('user_ads')->where('id', $adId)->increment('clicks', 1);
            DB::table('user_ads')->where('id', $adId)->increment('clicks_last_run', 1);
        }
        if (!str_starts_with($target, '/')) {
            return redirect('/');
        }
        return redirect($target);
    }

    private function pickAd(int $type): ?Ad
    {
        $ads = Ad::where('type', $type)->where('bid_amount', '>', 0)->get();
        if ($ads->isEmpty()) {
            return null;
        }
        $totalWeight = $ads->sum('bid_amount');
        $roll = rand(1, $totalWeight);
        $cumulative = 0;
        foreach ($ads as $ad) {
            $cumulative += $ad->bid_amount;
            if ($roll <= $cumulative) {
                return $ad;
            }
        }
        return $ads->last();
    }
    private function renderHouseAd(int $type)
    {
        $house = self::HOUSE_ADS[array_rand(self::HOUSE_ADS)];
        $dims  = self::AD_DIMENSIONS[$type];
        return view('ad.view', ['imageUrl' => $house['images'][$type], 'redirectUrl' => $house['href'], 'title' => $house['title'], 'adId' => null, 'assetId' => null, 'isHouse' => true, 'width' => $dims['width'], 'height' => $dims['height']]);
    }
}