<?php
namespace App\Http\Controllers\General\Backend\Economy;
use App\Models\Economy\PrivateSale;
use App\Models\Inventory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TakeOffSale
{
    public function takeOffSale(Request $request): JsonResponse
    {
        if (! auth()->check()) {
            return response()->json(['message' => 'You must be logged in to do that.'], 403);
        }
        $validated = $request->validate(['guid' => 'required|string']);
        $listing = PrivateSale::where('guid', $validated['guid'])->where('user_id', auth()->id())->first();
        if (! $listing) {
            return response()->json(['message' => 'This listing could not be found.'], 404);
        }
        $stillOwns = Inventory::where('user_id', auth()->id())->where('asset_id', $listing->asset_id)->where('guid', $listing->guid)->exists();
        if (! $stillOwns) {
            return response()->json(['message' => 'You no longer own this item.'], 422);
        }
        $listing->delete();
        return response()->json(['success' => true]);
    }
}
