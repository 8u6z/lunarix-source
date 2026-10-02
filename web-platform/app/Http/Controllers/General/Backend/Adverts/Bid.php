<?php
namespace App\Http\Controllers\General\Backend\Adverts;
use App\Models\Ad;
use Illuminate\Http\Request;

class Bid
{
    public function bid(Request $request)
    {
        $validated = $request->validate(['adId' => 'required|integer', 'bidAmount' => 'required|integer|min:10']);
        $user = $request->user();
        $ad = Ad::where('id', $validated['adId'])->whereHas('asset', fn($q) => $q->where('creator_id', $user->id))->firstOrFail();
        if ($user->moons < $validated['bidAmount']) {
            return response()->json(['success' => false, 'message' => 'Insufficient Bytes.'], 422);
        }
        $isNewRun = $ad->bid_amount === 0;
        $user->decrement('moons', $validated['bidAmount']);
        $ad->bid_amount += $validated['bidAmount'];
        $ad->bid_amount_last_run += $validated['bidAmount'];
        if ($isNewRun) {
            $ad->impressions = 0;
            $ad->clicks = 0;
        }
        $ad->save();
        return response()->json(['success' => true, 'bid_amount' => $ad->bid_amount]);
    }
}