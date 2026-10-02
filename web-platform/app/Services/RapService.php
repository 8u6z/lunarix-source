<?php
namespace App\Services;
use App\Models\Economy\RecentAveragePrice;

class RapService
{
    public static function recordSale(int $assetId, int $soldPrice): int
    {
        $currentRap = RecentAveragePrice::where('asset_id', $assetId)->orderByDesc('created_at')->value('rap');
        $currentRap ??= $soldPrice;
        $newRap = $currentRap + (int) round(($soldPrice - $currentRap) / 10);
        RecentAveragePrice::create(['asset_id' => $assetId, 'rap' => $newRap, 'created_at' => now()]);
        return $newRap;
    }
}