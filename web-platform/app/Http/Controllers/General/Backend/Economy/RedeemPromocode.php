<?php
namespace App\Http\Controllers\General\Backend\Economy;
use App\Models\Promocode;
use App\Models\PromocodeRedemption;
use App\Models\Asset;
use App\Models\Inventory;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedeemPromocode
{
    public function redeemPromocode(Request $request): JsonResponse
    {
        $user = $request->user();
        $code = trim((string) $request->query('code', ''));
        if ($code === '') {
            return response()->json(['errorMsg' => 'Please enter a code.']);
        }
        $promo = Promocode::where('code', $code)->first();
        if (! $promo) {
            return response()->json(['errorMsg' => 'That code is not valid.']);
        }
        if ($promo->isExpired()) {
            return response()->json(['errorMsg' => 'That code is not valid.']);
        }
        try {
            $result = DB::transaction(function () use ($user, $promo, $code) {
                $locked = Promocode::where('code', $code)->lockForUpdate()->first();
                PromocodeRedemption::create(['user_id' => $user->id, 'code' => $code, 'redeemed_at' => now()]);
                if ($locked->bytes_reward) {
                    $user->increment('moons', $locked->bytes_reward);
                }
                $grantedAssetNames = [];
                foreach ((array) $locked->assets_reward as $assetId) {
                    $asset = Asset::find($assetId);
                    if (! $asset) {
                        continue;
                    }
                    Inventory::create(['user_id' => $user->id, 'asset_id' => $asset->id, 'asset_type' => $asset->type, 'obtained_at' => now()]);
                    $grantedAssetNames[] = $asset->name;
                }
                return ['balance' => $user->fresh()->moons, 'assetNames' => $grantedAssetNames];
            });
        } catch (QueryException $e) {
            if ((int) $e->getCode() === 23505) {
                return response()->json(['errorMsg' => 'You have already redeemed this code.']);
            }
            throw $e;
        }
        $successSubText = 'Promo code successfully redeemed!';
        return response()->json(['balance' => $result['balance'], 'successMsg' => 'Promo code successfully redeemed!', 'successSubText' => $successSubText]);
    }
}
