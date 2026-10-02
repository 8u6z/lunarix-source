<?php
namespace App\Http\Controllers\General\Frontend\Catalog;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigureItem
{
    protected const FEE_PERCENT = 30;
    public function configureItem(Request $request)
    {
        $assetId = $request->query('id');
        $asset = Asset::where('id', $assetId)->where('creator_id', Auth::id())->firstOrFail();
        $feePercent = self::FEE_PERCENT;
        $price = $asset->price ?? 0;
        [$marketplaceFee, $sellerEarnings] = $this->calculateEarnings($price, $feePercent);
        return view('my.item', ['asset' => $asset, 'feePercent' => $feePercent, 'price' => $price, 'marketplaceFee' => $marketplaceFee, 'sellerEarnings' => $sellerEarnings]);
    }

    protected function calculateEarnings(int $price, int $feePercent): array
    {
        $fee = (int) floor($price * $feePercent / 100);
        $earnings = $price - $fee;
        return [$fee, $earnings];
    }
}
