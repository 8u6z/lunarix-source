<?php
namespace App\Http\Controllers\General\Backend\Economy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transactions
{
    public function getMyTransactions(Request $request)
    {
        $validated = $request->validate(['transactiontype' => 'required|string|in:purchase,sale,affiliatesale,grouppayout', 'startindex' => 'nullable|integer|min:0']);
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $typeMap = ['purchase' => 2, 'sale' => 1, 'affiliatesale' => 4, 'grouppayout' => 3];
        $txnTypeNames = [1 => 'Credit', 2 => 'Debit', 3 => 'Adjustment', 4 => 'Affiliate Sale'];
        $originTypeNames = [1 => 'Currency Purchase', 2 => 'Daily Login Award', 3 => 'Place Traffic Award', 4 => 'Sale of Goods', 5 => 'BC Signup Bonus', 6 => 'Misc Adjustment', 7 => 'Currency Trade', 8 => 'Trade System', 9 => 'BC Stipend', 10 => 'Admin Adjustment', 11 => 'Organic Acquisition (Targeted)', 12 => 'Organic Acquisition (Promoted)', 13 => 'Group Payout'];
        $typeId = $typeMap[$validated['transactiontype']];
        $startIndex = $validated['startindex'] ?? 0;
        $pageSize = 10;
        $query = DB::table('transaction_history')->where('user_id', $user->id)->where('transaction_type_id', $typeId);
        $totalCount = (clone $query)->count();
        $transactions = $query->orderByDesc('id')->skip($startIndex)->take($pageSize)->get();
        $data = $transactions->map(function ($t) use ($validated, $txnTypeNames, $originTypeNames) {
            $product = null;
            $productLink = null;
            $creatorId = 1;
            if ($t->sale_id) {
                $asset = DB::table('assets')->where('id', $t->sale_id)->first();
                if ($asset) {
                    $product = $asset;
                    $creatorId = $asset->creator_id ?? 1;
                    $productLink = "/Item.aspx?id={$asset->id}";
                }
            }
            if (!$product) {
                $product = (object) ['name' => $originTypeNames[$t->transaction_origin_type_id] ?? 'Unknown'];
                $creatorId = 1;
            }
            $creator = DB::table('users')->where('id', $creatorId)->first();
            $item = [
                'Date' => date('m/d/Y', strtotime($t->created_at)),
                'Member' => $creator->username ?? 'Unknown',
                'Member_ID' => $creator->id ?? 0,
                'Description' => isset($product->id) ? ($txnTypeNames[$t->transaction_type_id] ?? 'Unknown') : 'Earned ' . ($txnTypeNames[$t->transaction_type_id] ?? 'Unknown'),
                'Amount' => (string) ($t->amount ?? 0),
                'Amount_Class' => $validated['transactiontype'] === 'purchase' ? 'negative' : 'positive',
                'Currency' => 'robux',
                'Item_Name' => $product->name ?? 'Unknown',
                'Item_Url' => $productLink,
            ];
            return json_encode($item);
        });
        return response()->json(['d' => json_encode(['StartIndex' => $startIndex + $pageSize, 'TotalCount' => $totalCount, 'Data' => $data])]);
    }
}
