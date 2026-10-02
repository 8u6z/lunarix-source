<?php
namespace App\Http\Controllers\RBXApis\Marketplace;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Request;

class ProductInfo extends Controller
{
    public function productInfo(Request $request)
    {
        $assetId = $request->query('assetId');
        if (!$assetId || !is_numeric($assetId)) {
            return response()->json(['errors' => [['code' => 0, 'message' => 'assetId is required.']]], 400);
        }
        $asset = Asset::with('creator')->find((int) $assetId);
        if (!$asset) {
            return response()->json(['errors' => [['code' => 0, 'message' => 'Asset not found.']]], 404);
        }
        $creator = $asset->creator;
        return response()->json([
            'Name' => $asset->name,
            'Description' => $asset->description ?? '',
            'Created' => $asset->created_at->toIso8601String(),
            'Updated' => $asset->updated_at->toIso8601String(),
            'PriceInRobux' => $asset->robux,
            'PriceInTickets' => null,
            'AssetId' => $asset->id,
            'ProductId' => $asset->id,
            'AssetTypeId' => $asset->type,
            'Creator' => [
                'Id' => $creator->id,
                'Name' => $creator->username,
                'CreatorType' => 'User',
            ],
            'MinimumMembershipLevel' => 0,
            'IsForSale' => (bool) $asset->onsale,
        ]);
    }
}