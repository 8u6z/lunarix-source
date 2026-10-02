<?php

namespace App\Http\Controllers\RBXApis\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Inventory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchAssets extends Controller
{
    public function fetchJson(Request $request): JsonResponse
    {
        $userId = (int) $request->query('userId');
        $assetTypeId = (int) $request->query('assetTypeId');
        $page = max(1, (int) $request->query('pageNumber', 1));
        $perPage = 50;
        $response = [
            'IsValid' => true,
            'Data' => ['TotalItems' => 0, 'Start' => 0, 'End' => 0, 'Page' => $page, 'ItemsPerPage' => $perPage, 'PageType' => 'inventory', 'Items' => []],
        ];
        $vieweduser = User::find($userId);
        if (! $vieweduser) {
            return response()->json($response);
        }
        $base = Inventory::where('user_id', $vieweduser->id)->whereHas('asset', fn ($q) => $q->where('type', $assetTypeId)->notGhosted()->publiclyAvailable())->orderByDesc('obtained_at');
        $totalItems = $base->count();
        $rows = $base->with('asset.creator')->forPage($page, $perPage)->get();
        $response['Data']['Items'] = $rows->map(function ($inv) {
            $asset = $inv->asset;
            $creator = $asset->creator;
            $price = (int) $asset->robux;
            $isFree = ! $asset->onsale || $price <= 0;

            return [
                'Item' => [
                    'AssetId' => $asset->id,
                    'Name' => $asset->name,
                    'AbsoluteUrl' => '/'.$asset->getSlug().'-item?id='.$asset->id,
                    'AssetType' => $asset->type,
                    'AssetTypeFriendlyLabel' => null,
                    'Description' => $asset->description,
                    'Genres' => null,
                ],
                'Creator' => [
                    'Id' => $creator->id ?? null,
                    'Name' => $creator->username ?? '[unknown]',
                    'Type' => 1,
                    'CreatorProfileLink' => '/users/'.($creator->id ?? 0).'/profile/',
                ],
                'Product' => [
                    'Id' => $asset->id,
                    'PriceInRobux' => $isFree ? null : $price,
                    'PriceInTickets' => null,
                    'IsForSale' => (bool) $asset->onsale,
                    'IsPublicDomain' => false,
                    'IsResellable' => false,
                    'IsLimited' => (bool) $asset->is_limited,
                    'IsLimitedUnique' => (bool) $asset->is_limited_unique,
                    'SerialNumber' => $inv->serial_number,
                    'IsRental' => false,
                    'RentalDurationInHours' => null,
                    'BcRequirement' => 0,
                    'TotalPrivateSales' => 0,
                    'SellerId' => null,
                    'SellerName' => null,
                    'LowestPrivateSaleUserAssetId' => null,
                    'IsXboxExclusiveItem' => false,
                    'OffsaleDeadline' => null,
                    'NoPriceText' => $isFree ? 'Free' : null,
                ],
                'PrivateServer' => null,
                'Thumbnail' => [
                    'Final' => true,
                    'Url' => '/Thumbs/Asset.ashx?assetId='.$asset->id,
                    'RetryUrl' => '',
                    'IsApproved' => true,
                ],
            ];
        })->values()->all();
        $response['Data']['TotalItems'] = $totalItems;
        $response['Data']['Start'] = ($page - 1) * $perPage;
        $response['Data']['End'] = $totalItems > 0 ? min($response['Data']['Start'] + $perPage, $totalItems) - 1 : 0;

        return response()->json($response);
    }

    public function fetchRecommendedJson(Request $request): JsonResponse
    {
        $assetTypeId = (int) $request->query('assetTypeId');
        $limit = 6;
        $userId = auth()->id();
        $assets = Asset::ofType($assetTypeId)->notGhosted()->publiclyAvailable()->when($userId, function ($q) use ($userId) {
            $q->whereDoesntHave('inventoryEntries', fn ($iq) => $iq->where('user_id', $userId));
        })->with('creator')->inRandomOrder()->limit($limit)->get();
        $items = $assets->map(function (Asset $asset) {
            $creator = $asset->creator;

            return [
                'Item' => [
                    'AssetId' => $asset->id,
                    'Name' => $asset->name,
                    'AbsoluteUrl' => '/'.$asset->getSlug().'-item?id='.$asset->id,
                ],
                'Creator' => [
                    'UserId' => $creator->id ?? null,
                    'Name' => $creator->username ?? '[unknown]',
                ],
                'Thumbnail' => [
                    'Final' => true,
                    'Url' => '/Thumbs/Asset.ashx?assetId='.$asset->id,
                    'RetryUrl' => '',
                ],
            ];
        })->values()->all();

        return response()->json([
            'IsValid' => true,
            'Data' => ['Items' => $items],
        ]);
    }
}
