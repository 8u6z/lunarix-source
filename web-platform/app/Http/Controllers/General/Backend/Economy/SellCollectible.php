<?php
namespace App\Http\Controllers\General\Backend\Economy;
use App\Models\Asset;
use App\Models\Economy\PrivateSale;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellCollectible
{
    public function sellCollectible(Request $request): JsonResponse
    {
        if (! auth()->check()) {
            return response()->json(['message' => 'You must be logged in to do that.'], 403);
        }
        $user = auth()->user();
        if ((int) $user->membership <= 0) {
            return response()->json(['message' => 'Only Bloxxers Club members may re-sell collectible items.'], 403);
        }
        $validated = $request->validate(['assetId' => 'required|integer', 'price' => 'required|integer|min:1', 'guid' => 'required|string']);
        $asset = Asset::find($validated['assetId']);
        if (! $asset || ! ($asset->is_limited || $asset->is_limited_unique)) {
            return response()->json(['message' => 'This item cannot be resold.'], 422);
        }
        try {
            $listing = DB::transaction(function () use ($user, $asset, $validated) {
                $inventoryItem = Inventory::where('user_id', $user->id)->where('asset_id', $asset->id)->where('guid', $validated['guid'])->lockForUpdate()->first();
                if (! $inventoryItem) {
                    throw new \RuntimeException('not_owned');
                }
                $alreadyListed = PrivateSale::where('guid', $validated['guid'])->where('asset_id', $asset->id)->exists();
                if ($alreadyListed) {
                    throw new \RuntimeException('already_listed');
                }
                return PrivateSale::create(['user_id' => $user->id,'asset_id' => $asset->id, 'guid' => $inventoryItem->guid, 'serial' => $inventoryItem->serial_number, 'price' => $validated['price'], 'created_at' => now()]);
            });
        } catch (\RuntimeException $e) {
            $message = match ($e->getMessage()) {
                'not_owned' => 'You do not own this item.',
                'already_listed' => 'This item is already listed for sale.',
                default => 'An error occured while listing this item. Please try again later.',
            };
            return response()->json(['message' => $message], 422);
        }
        return response()->json(['success' => true, 'listingId' => $listing->id]);
    }
}
