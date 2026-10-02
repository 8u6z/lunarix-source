<?php
namespace App\Http\Controllers\General\Backend\Economy;
use App\Models\Inventory;
use App\Models\Economy\Trade;
use App\Models\Economy\TradeItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Trades
{
    private const MAX_ITEMS_PER_SIDE = 4;
    private const TRADE_EXPIRY_SECONDS = 60 * 60 * 24 * 14;
    public function getMyItemTrades(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $validated = $request->validate(['statustype' => 'required|string|in:inbound,outbound,completed,inactive', 'startindex' => 'required|integer|min:0']);
        $query = Trade::query()->with(['sender:id,username', 'receiver:id,username']);
        switch ($validated['statustype']) {
            case 'inbound':
                $query->where('receiver_id', $userId)->where('status', 'pending');
                break;
            case 'outbound':
                $query->where('sender_id', $userId)->where('status', 'pending');
                break;
            case 'completed':
                $query->where('status', 'accepted')->where(fn($q) => $q->where('sender_id', $userId)->orWhere('receiver_id', $userId));
                break;
            case 'inactive':
                $query->whereIn('status', ['declined', 'cancelled', 'expired'])->where(fn($q) => $q->where('sender_id', $userId)->orWhere('receiver_id', $userId));
                break;
        }
        $trades = $query->orderByDesc('created_at')->skip($validated['startindex'])->take(25)->get();
        $tradeIds = $trades->pluck('id');
        $items = TradeItem::query()->whereIn('trade_id', $tradeIds)->with(['inventoryItem.asset:id,name'])->get()->groupBy('trade_id');
        $statusMap = ['pending' => 'Open', 'accepted' => 'Finished', 'declined' => 'Declined', 'cancelled' => 'Rejected', 'expired' => 'Expired'];
        $result = $trades->map(function ($trade) use ($items, $userId, $statusMap) {
            $tradeItems = $items->get($trade->id, collect());
            $partner = $trade->sender_id === $userId ? $trade->receiver : $trade->sender;
            $mapItem = fn($ti) => ['inventory_id' => $ti->inventory_id, 'name' => $ti->inventoryItem->asset->name ?? null, 'thumbnail' => $ti->inventoryItem->asset->id ? '/Thumbs/Asset.ashx?assetId=' . $ti->inventoryItem->asset->id : null];
            return json_encode([
                'Date' => \Carbon\Carbon::parse($trade->created_at)->format('M d, Y'),
                'Expires' => $trade->expires_at ?? '',
                'TradePartner' => $partner->username,
                'TradePartnerID' => $partner->id,
                'TradeSessionID' => $trade->id,
                'Status' => $statusMap[$trade->status] ?? ucfirst($trade->status),
                'StatusAddon' => '',
                'yourItems' => $tradeItems->where('user_id', $userId)->map($mapItem)->values(),
                'theirItems' => $tradeItems->where('user_id', '!=', $userId)->map($mapItem)->values(),
                'yourRobux' => $trade->sender_id === $userId ? $trade->sender_robux : $trade->receiver_robux,
                'theirRobux' => $trade->sender_id === $userId ? $trade->receiver_robux : $trade->sender_robux,
            ]);
        })->values()->all();
        return response()->json(['d' => json_encode(['tradeWriteEnabled' => 'True', 'Data' => $result, 'totalCount' => count($result)])]);
    }

    public function create(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $validated = $request->validate(['receiver_id' => 'required|integer|exists:users,id|different:sender_id', 'sender_inventory_ids' => 'required|array|min:1|max:' . self::MAX_ITEMS_PER_SIDE, 'sender_inventory_ids.*' => 'integer', 'receiver_inventory_ids' => 'required|array|min:1|max:' . self::MAX_ITEMS_PER_SIDE, 'receiver_inventory_ids.*' => 'integer', 'sender_robux' => 'sometimes|integer|min:0', 'receiver_robux' => 'sometimes|integer|min:0']);
        if ($validated['receiver_id'] === $userId) {
            abort(422, 'You cannot trade with yourself.');
        }
        $trade = DB::transaction(function () use ($validated, $userId) {
            $senderItems = $this->lockAndValidateItems($validated['sender_inventory_ids'], $userId);
            $receiverItems = $this->lockAndValidateItems($validated['receiver_inventory_ids'], $validated['receiver_id']);
            $trade = Trade::create(['sender_id' => $userId, 'receiver_id' => $validated['receiver_id'], 'status' => 'pending', 'sender_robux' => $validated['sender_robux'] ?? 0, 'receiver_robux' => $validated['receiver_robux'] ?? 0, 'expires_at' => now()->addSeconds(self::TRADE_EXPIRY_SECONDS)->timestamp]);
            foreach ($senderItems as $item) {
                TradeItem::create(['trade_id' => $trade->id, 'user_id' => $userId, 'inventory_id' => $item->id]);
                $item->update(['is_locked' => true]);
            }
            foreach ($receiverItems as $item) {
                TradeItem::create(['trade_id' => $trade->id, 'user_id' => $validated['receiver_id'], 'inventory_id' => $item->id]);
                $item->update(['is_locked' => true]);
            }
            return $trade;
        });
        return response()->json(['data' => ['id' => $trade->id]], 201);
    }

    public function accept(Request $request, int $id): JsonResponse
    {
        $userId = $request->user()->id;
        $trade = Trade::where('id', $id)->where('receiver_id', $userId)->where('status', 'pending')->firstOrFail();
        if ($trade->expires_at !== null && $trade->expires_at < now()->timestamp) {
            $this->expireTrade($trade);
            abort(410, 'This trade has expired.');
        }
        DB::transaction(function () use ($trade) {
            $items = TradeItem::where('trade_id', $trade->id)->lockForUpdate()->get();
            foreach ($items as $tradeItem) {
                $newOwnerId = $tradeItem->user_id === $trade->sender_id ? $trade->receiver_id : $trade->sender_id;
                Inventory::where('id', $tradeItem->inventory_id)->update(['user_id' => $newOwnerId, 'is_locked' => false]);
            }
            if ($trade->sender_robux > 0) {
                DB::table('users')->where('id', $trade->sender_id)->decrement('robux', $trade->sender_robux);
                DB::table('users')->where('id', $trade->receiver_id)->increment('robux', $trade->sender_robux);
            }
            if ($trade->receiver_robux > 0) {
                DB::table('users')->where('id', $trade->receiver_id)->decrement('robux', $trade->receiver_robux);
                DB::table('users')->where('id', $trade->sender_id)->increment('robux', $trade->receiver_robux);
            }
            $trade->update(['status' => 'accepted']);
        });
        return response()->json(['data' => ['status' => 'accepted']]);
    }

    public function decline(Request $request, int $id): JsonResponse
    {
        $userId = $request->user()->id;
        $trade = Trade::where('id', $id)->where('receiver_id', $userId)->where('status', 'pending')->firstOrFail();
        $this->releaseTradeItems($trade);
        $trade->update(['status' => 'declined']);
        return response()->json(['data' => ['status' => 'declined']]);
    }

    public function cancel(Request $request, int $id): JsonResponse
    {
        $userId = $request->user()->id;
        $trade = Trade::where('id', $id)->where('sender_id', $userId)->where('status', 'pending')->firstOrFail();
        $this->releaseTradeItems($trade);
        $trade->update(['status' => 'cancelled']);
        return response()->json(['data' => ['status' => 'cancelled']]);
    }

    public function tradeHandler(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $tradeId = $request->input('TradeID');
        $cmd = $request->input('cmd');
        if ($cmd !== 'pull') {
            abort(400, 'Unsupported command.');
        }
        $trade = Trade::where('id', $tradeId)->where(fn($q) => $q->where('sender_id', $userId)->orWhere('receiver_id', $userId))->with(['sender:id,username', 'receiver:id,username'])->firstOrFail();
        $items = TradeItem::where('trade_id', $trade->id)->with(['inventoryItem.asset:id,name,robux'])->get();
        $statusMap = ['pending' => 'Open', 'accepted' => 'Finished', 'declined' => 'Declined', 'cancelled' => 'Rejected', 'expired' => 'Expired'];
        $buildOfferList = function ($ownerId) use ($items) {
            return $items->where('user_id', $ownerId)->map(fn($ti) => [
                'UserAssetID' => $ti->inventory_id,
                'AssetID' => $ti->inventoryItem->asset->id ?? 0,
                'Name' => $ti->inventoryItem->asset->name ?? '',
                'ThumbnailUrl'=> $ti->inventoryItem->asset->id ? '/Thumbs/Asset.ashx?assetId=' . $ti->inventoryItem->asset->id : '',
                'OriginalPrice' => $ti->inventoryItem->asset->robux ?? 0,
                'AveragePrice' => $ti->inventoryItem->asset->robux ?? 0,
                'SerialNumber' => $ti->inventoryItem->serial_number ?? null,
            ])->values()->all();
        };
        $senderRobux = $trade->sender_id === $userId ? $trade->sender_robux : $trade->receiver_robux;
        $receiverRobux = $trade->sender_id === $userId ? $trade->receiver_robux : $trade->sender_robux;
        $data = json_encode([
            'StatusType' => $statusMap[$trade->status] ?? ucfirst($trade->status),
            'IsActive' => $trade->status === 'pending',
            'Expiration' => '/Date(' . (\Carbon\Carbon::parse($trade->expires_at)->timestamp * 1000) . ')/',
            'AgentOfferList' => [
                [
                    'AgentID' => $trade->sender_id,
                    'OfferValue' => 0,
                    'OfferRobux' => $trade->sender_robux,
                    'OfferList' => $buildOfferList($trade->sender_id),
                ],
                [
                    'AgentID' => $trade->receiver_id,
                    'OfferValue' => 0,
                    'OfferRobux' => $trade->receiver_robux,
                    'OfferList' => $buildOfferList($trade->receiver_id),
                ],
            ],
        ]);
        return response()->json(['success' => true, 'data' => $data]);
    }

    private function lockAndValidateItems(array $inventoryIds, int $ownerId)
    {
        $items = Inventory::query()->whereIn('id', $inventoryIds)->where('user_id', $ownerId)->with('asset:id,is_limited,is_limited_unique')->lockForUpdate()->get();
        if ($items->count() !== count($inventoryIds)) {
            abort(422, 'One or more items are invalid or not owned by the correct user.');
        }
        foreach ($items as $item) {
            $asset = $item->asset;
            if (!$asset || (!$asset->is_limited && !$asset->is_limited_unique)) {
                abort(422, 'Only Limited and Limited Unique items can be traded.');
            }
            if ($item->is_locked) {
                abort(422, 'One or more items are already locked in another trade.');
            }
        }
        return $items;
    }

    private function releaseTradeItems(Trade $trade): void
    {
        $inventoryIds = TradeItem::where('trade_id', $trade->id)->pluck('inventory_id');
        Inventory::whereIn('id', $inventoryIds)->update(['is_locked' => false]);
    }

    private function expireTrade(Trade $trade): void
    {
        $this->releaseTradeItems($trade);
        $trade->update(['status' => 'expired']);
    }
}