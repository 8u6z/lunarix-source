<?php
namespace App\Http\Controllers\General\Frontend;
use App\Models\Asset;

class CharacterCustomizer
{
    public function characterCustomizer()
    {
        $user = auth()->user()->load('body');
        $categoryMap = ['Head' => Asset::TYPE_HEAD, 'Face' => Asset::TYPE_FACE, 'Hat' => Asset::TYPE_HAT, 'T-Shirt' => Asset::TYPE_TSHIRT, 'Shirt' => Asset::TYPE_SHIRT, 'Pants' => Asset::TYPE_PANTS, 'Gear' => Asset::TYPE_GEAR, 'Torso' => Asset::TYPE_TORSO, 'LArm' => Asset::TYPE_LEFT_ARM, 'RArm' => Asset::TYPE_RIGHT_ARM, 'LLeg' => Asset::TYPE_LEFT_LEG, 'RLeg' => Asset::TYPE_RIGHT_LEG, 'Package' => Asset::TYPE_PACKAGE];
        $currentCategory = request('category', 'Hat');
        $assetType = $categoryMap[$currentCategory] ?? Asset::TYPE_HAT;
        $wornAssets = $user->wornAssets()->paginate(8, ['*'], 'worn_page')->appends(request()->except('worn_page'));
        $wornAssetIds = $user->wornAssets()->pluck('assets.id');
        $latestRows = $user->inventory()->ofType($assetType)->whereNotIn('asset_id', $wornAssetIds)->selectRaw('asset_id, MAX(obtained_at) as obtained_at')->groupBy('asset_id')->get();
        $inventoryTotal = $latestRows->count();
        $inventoryPerPage = 8;
        $inventoryLastPage = max(1, (int) ceil($inventoryTotal / $inventoryPerPage));
        $inventoryPage = min((int) request('inventory_page', 1), $inventoryLastPage);
        if ($latestRows->isEmpty()) {
            $inventory = $user->inventory()->whereRaw('1 = 0')->paginate($inventoryPerPage, ['*'], 'inventory_page', $inventoryPage)->appends(request()->except('inventory_page'));
        } else {
            $inventoryQuery = $user->inventory()->ofType($assetType)->where(function ($q) use ($latestRows) {
                    foreach ($latestRows as $row) {
                        $q->orWhere(function ($q2) use ($row) {
                            $q2->where('asset_id', $row->asset_id)->where('obtained_at', $row->obtained_at);
                        });
                    }
                })->with('asset')->orderBy('obtained_at', 'desc');
            $inventory = $inventoryQuery->paginate($inventoryPerPage, ['*'], 'inventory_page', $inventoryPage)->appends(request()->except('inventory_page'));
        }
        return view('my.character', array_merge(['title' => 'Avatar - Lunarix'], compact('user', 'wornAssets', 'inventory', 'currentCategory')));
    }
}
