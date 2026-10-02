<?php
namespace App\Http\Controllers\General\Backend\Economy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Summary
{
    public function getMySummary(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $validated = $request->validate(['timePeriod' => 'nullable|string|in:day,week,month,year']);
        $userId = $user->id;
        $calc = ['day' => '-1 days', 'week' => '-7 days', 'month' => '-30 days', 'year' => '-365 days'];
        $fromDate = now()->modify($calc[$validated['timePeriod'] ?? 'week']);
        $sum = function (int $typeId, int $originId, int $currencyId) use ($userId, $fromDate) {
            return (int) DB::table('transaction_history')->where('user_id', $userId)->where('transaction_type_id', $typeId)->where('transaction_origin_type_id', $originId)->where('currency_type_id', $currencyId)->where('created_at', '>=', $fromDate)->sum('amount');
        };
        $summary = [
            'R_SaleOfGoods' => $sum(1, 4, 1),
            'R_GroupPayouts' => $sum(1, 13, 1),
            'R_TradeSystem' => $sum(1, 8, 1),
            'R_PendingSales' => 0,
            'CurrencyPurchase' => $sum(1, 1, 1),
            'PromotedPageConversionRevenue' => $sum(1, 12, 1),
            'GamePageConversionRevenue' => $sum(1, 11, 1),
            'LoginAward' => $sum(1, 2, 2),
            'PlaceTraffic' => $sum(1, 3, 2),
            'R_Total' => 0
        ];
        $rKeys = ['R_SaleOfGoods', 'R_GroupPayouts', 'R_TradeSystem', 'CurrencyPurchase', 'PromotedPageConversionRevenue', 'GamePageConversionRevenue', 'LoginAward', 'PlaceTraffic'];
        $summary['R_Total'] = array_sum(array_intersect_key($summary, array_flip($rKeys)));
        return response()->json(['d' => json_encode($summary)]);
    }
}
