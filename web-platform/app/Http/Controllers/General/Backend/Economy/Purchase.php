<?php
namespace App\Http\Controllers\General\Backend\Economy;
use App\Models\Asset;
use App\Models\Economy\PrivateSale;
use App\Models\User;
use App\Services\RapService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Purchase
{
    public function purchase(Request $request)
    {
        if ($request->rqtype !== 'purchase') {
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => 'An error occured while processing this transaction. No ROBUX have been removed from your account. Please try again later.'], 500);
        }
        if (! auth()->check()) {
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => 'An error occured while processing this transaction. No ROBUX have been removed from your account. Please try again later.'], 500);
        }
        $user = auth()->user();
        $expectedPrice = (int) $request->expectedPrice;
        $expectedSellerId = (int) $request->expectedSellerID;
        $assetId = (int) $request->productID;
        $userAssetId = $request->input('userAssetID');
        $asset = Asset::where('id', $assetId)->first();
        if (! $asset) {
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => 'An error occured while processing this transaction. No ROBUX have been removed from your account. Please try again later.'], 500);
        }
        if (! $asset->isPubliclyAvailable()) {
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => 'This item is awaiting moderation.'], 403);
        }
        if ($userAssetId) {
            return $this->purchasePrivateSale($user, $asset, (string) $userAssetId, $expectedPrice, $expectedSellerId);
        }
        if (! $asset->onsale) {
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => 'An error occured while processing this transaction. No ROBUX have been removed from your account. Please try again later.'], 500);
        }
        if ($asset->creator_id !== $expectedSellerId) {
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => 'An error occured while processing this transaction. No ROBUX have been removed from your account. Please try again later.'], 500);
        }
        $alreadyOwns = DB::table('user_inventory')->where('user_id', $user->id)->where('asset_id', $asset->id)->exists();
        if ($alreadyOwns && ! ($asset->is_limited || $asset->is_limited_unique)) {
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => 'You already own this item.'], 500);
        }
        if ($asset->robux !== $expectedPrice) {
            return response()->json(['showDivID' => 'PriceChangedView', 'expectedPrice' => $expectedPrice, 'currentPrice' => $asset->robux, 'balanceAfterSale' => $user->moons - $asset->robux], 500);
        }
        if ($asset->robux > 0 && $user->moons < $asset->robux) {
            return response()->json(['showDivID' => 'InsufficientFundsView', 'currentCurrency' => 1, 'shortfallPrice' => $asset->robux - $user->moons], 500);
        }
        try {
            DB::transaction(function () use ($user, $assetId, $expectedPrice, $expectedSellerId) {
                $lockedAsset = Asset::where('id', $assetId)->lockForUpdate()->firstOrFail();
                $lockedUser = User::where('id', $user->id)->lockForUpdate()->firstOrFail();
                $lockedSeller = User::where('id', $expectedSellerId)->lockForUpdate()->firstOrFail();
                if (! $lockedAsset->isPubliclyAvailable()) {
                    throw new \RuntimeException('awaiting_moderation');
                }
                if (! $lockedAsset->onsale) {
                    throw new \RuntimeException('not_for_sale');
                }
                if ((int) $lockedAsset->creator_id !== $expectedSellerId || (int) $lockedAsset->robux !== $expectedPrice) {
                    throw new \RuntimeException('asset_changed');
                }
                if (! ($lockedAsset->is_limited || $lockedAsset->is_limited_unique) && DB::table('user_inventory')->where('user_id', $lockedUser->id)->where('asset_id', $lockedAsset->id)->exists()) {
                    throw new \RuntimeException('already_owned');
                }
                if ($lockedAsset->isSoldOut()) {
                    throw new \RuntimeException('sold_out');
                }
                if ($lockedAsset->robux > 0 && $lockedUser->moons < $lockedAsset->robux) {
                    throw new \RuntimeException('insufficient_funds');
                }
                if ($lockedAsset->robux > 0) {
                    $lockedUser->decrement('moons', $lockedAsset->robux);
                    $sellerCut = (int) floor($lockedAsset->robux * 0.70);
                    $lunarixCut = $lockedAsset->robux - $sellerCut;
                    if ($lockedAsset->creator_id === 1) {
                        User::where('id', 1)->increment('moons', $lockedAsset->robux);
                    } else {
                        User::where('id', $lockedAsset->creator_id)->increment('moons', $sellerCut);
                        User::where('id', 1)->increment('moons', $lunarixCut);
                    }
                }
                $nextSaleNumber = $lockedAsset->sales_count + 1;
                DB::table('user_inventory')->insert(['user_id' => $lockedUser->id, 'asset_id' => $lockedAsset->id, 'asset_type' => $lockedAsset->type, 'obtained_at' => now(), 'serial_number' => $lockedAsset->is_limited_unique ? $nextSaleNumber : null, 'guid' => (string) Str::uuid()]);
                $lockedAsset->update(['sales_count' => $nextSaleNumber]);
                if ($lockedAsset->robux > 0) {
                    $now = now();
                    $rows = [
                        [
                            'transaction_type_id' => 2,
                            'transaction_origin_type_id' => 1,
                            'currency_type_id' => 1,
                            'user_id' => $lockedUser->id,
                            'sale_id' => $lockedAsset->id,
                            'amount' => $lockedAsset->robux,
                            'is_processed' => true,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ],
                        [
                            'transaction_type_id' => 1,
                            'transaction_origin_type_id' => 4,
                            'currency_type_id' => 1,
                            'user_id' => $lockedSeller->id,
                            'sale_id' => $lockedAsset->id,
                            'amount' => $sellerCut,
                            'is_processed' => true,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ],
                    ];
                    if ($lockedAsset->creator_id !== 1) {
                        $rows[] = [
                            'transaction_type_id' => 1,
                            'transaction_origin_type_id' => 4,
                            'currency_type_id' => 1,
                            'user_id' => $lockedAsset->creator_id,
                            'sale_id' => $lockedAsset->id,
                            'amount' => $sellerCut,
                            'is_processed' => true,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    DB::table('transaction_history')->insert($rows);
                }
                if (($lockedAsset->is_limited || $lockedAsset->is_limited_unique) && $lockedAsset->robux > 0) {
                    RapService::recordSale($lockedAsset->id, $lockedAsset->robux);
                }
            });
        } catch (\RuntimeException $e) {
            $message = match ($e->getMessage()) {
                'already_owned' => 'You already own this item.',
                'sold_out' => 'This limited item is sold out.',
                'not_for_sale' => 'This item is no longer for sale.',
                'insufficient_funds' => 'You do not have enough Bytes to purchase this item.',
                'asset_changed' => 'The item changed while you were purchasing it. Please refresh and try again.',
                'awaiting_moderation' => 'This item is awaiting moderation.',
                default => 'An error occured while processing this transaction. No Bytes have been removed from your account. Please try again later.',
            };
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => $message], 500);
        } catch (\Exception $e) {
            return response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => 'An error occured while processing this transaction. No ROBUX have been removed from your account. Please try again later.'], 500);
        }
        return response()->json(['TransactionVerb' => 'purchased', 'AssetName' => $asset->name, 'AssetType' => $asset->getTypeName(), 'SellerName' => $asset->creator->username, 'Price' => $asset->robux]);
    }

    private function purchasePrivateSale($user, Asset $asset, string $userAssetId, int $expectedPrice, int $expectedSellerId): JsonResponse
    {
        $fail = fn (string $msg) => response()->json(['showDivID' => 'TransactionFailureView', 'title' => 'Error', 'errorMsg' => $msg], 500);
        $listing = PrivateSale::where('guid', $userAssetId)->where('asset_id', $asset->id)->first();
        if (! $listing) {
            return $fail('This listing is no longer available.');
        }
        if ((int) $listing->user_id === (int) $user->id) {
            return $fail('You cannot buy your own listing.');
        }
        $alreadyOwns = DB::table('user_inventory')->where('user_id', $user->id)->where('asset_id', $asset->id)->exists();
        if ($alreadyOwns && ! ($asset->is_limited || $asset->is_limited_unique)) {
            return $fail('You already own this item.');
        }
        try {
            DB::transaction(function () use ($user, $asset, $listing, $expectedPrice, $expectedSellerId) {
                $lockedListing = PrivateSale::where('id', $listing->id)->lockForUpdate()->first();
                if (! $lockedListing) {
                    throw new \RuntimeException('sold_out');
                }
                if ((int) $lockedListing->user_id !== $expectedSellerId || (int) $lockedListing->price !== $expectedPrice) {
                    throw new \RuntimeException('asset_changed');
                }
                $lockedBuyer = User::where('id', $user->id)->lockForUpdate()->firstOrFail();
                $lockedSeller = User::where('id', $lockedListing->user_id)->lockForUpdate()->firstOrFail();
                if ($lockedListing->price > 0 && $lockedBuyer->moons < $lockedListing->price) {
                    throw new \RuntimeException('insufficient_funds');
                }
                if ($lockedListing->price > 0) {
                    $lockedBuyer->decrement('moons', $lockedListing->price);
                    $sellerCut = (int) floor($lockedListing->price * 0.70);
                    $lunarixCut = $lockedListing->price - $sellerCut;
                    $lockedSeller->increment('moons', $sellerCut);
                    User::where('id', 1)->increment('moons', $lunarixCut);
                }
                $updated = DB::table('user_inventory')->where('user_id', $lockedListing->user_id)->where('asset_id', $asset->id)->where('guid', $lockedListing->guid)->update(['user_id' => $lockedBuyer->id, 'obtained_at' => now()]);
                if ($updated !== 1) {
                    throw new \RuntimeException('could_not_find_collectible');
                }
                $lockedListing->delete();
                if ($lockedListing->price > 0) {
                    $now = now();
                    DB::table('transaction_history')->insert([
                        [
                            'transaction_type_id' => 2,
                            'transaction_origin_type_id' => 1,
                            'currency_type_id' => 1,
                            'user_id' => $lockedBuyer->id,
                            'sale_id' => $asset->id,
                            'amount' => $lockedListing->price,
                            'is_processed' => true,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ],
                        [
                            'transaction_type_id' => 1,
                            'transaction_origin_type_id' => 4,
                            'currency_type_id' => 1,
                            'user_id' => $lockedSeller->id,
                            'sale_id' => $asset->id,
                            'amount' => $sellerCut,
                            'is_processed' => true,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ],
                    ]);
                }
                if (($asset->is_limited || $asset->is_limited_unique) && $lockedListing->price > 0) {
                    RapService::recordSale($asset->id, $lockedListing->price);
                }
            });
        } catch (\RuntimeException $e) {
            $message = match ($e->getMessage()) {
                'sold_out' => 'This listing is no longer available.',
                'asset_changed' => 'The listing changed while you were purchasing it. Please refresh and try again.',
                'insufficient_funds' => 'You do not have enough Bytes to purchase this item.',
                'could_not_find_collectible' => 'The collectible could not be bought because the seller no longer owns it.',
                default => 'An error occured while processing this transaction. No Bytes have been removed from your account. Please try again later.',
            };
            return $fail($message);
        } catch (\Exception $e) {
            return $fail('An error occured while processing this transaction. No Bytes have been removed from your account. Please try again later.');
        }
        return response()->json(['TransactionVerb' => 'purchased', 'AssetName' => $asset->name, 'AssetType' => $asset->getTypeName(), 'SellerName' => optional(User::find($expectedSellerId))->username, 'Price' => $expectedPrice]);
    }
}
