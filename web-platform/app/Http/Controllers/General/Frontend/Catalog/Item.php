<?php
namespace App\Http\Controllers\General\Frontend\Catalog;
use App\Models\Asset;
use App\Models\Economy\PrivateSale;
use App\Models\Economy\RecentAveragePrice;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Item
{
    public function item(Request $request)
    {
        $id = $request->query('id');
        $asset = Asset::with('creator')->findOrFail($id);
        if (! $asset->isPubliclyAvailable() && (! auth()->check() || (int) auth()->user()->roleset < 1)) {
            abort(404);
        }
        $correctSlug = $asset->getSlug();
        $currentSlug = $request->route('slug');
        if ($currentSlug !== $correctSlug) {
            return redirect("/{$correctSlug}-item?id={$asset->id}");
        }
        if ($asset->type === Asset::TYPE_PLACE) {
            return redirect("/games/{$asset->id}/{$asset->getSlug()}");
        }
        $recommendations = Asset::where('id', '!=', $asset->id)->where('type', $asset->type)->publiclyAvailable()->where('onsale', true)->where('ghosted', false)->inRandomOrder()->limit(10)->get();
        $freeItems = Asset::where('robux', 0)->publiclyAvailable()->where('onsale', true)->where('ghosted', false)->where('id', '!=', $asset->id)->inRandomOrder()->limit(6)->get();
        $userOwns = auth()->check() && ! $asset->is_limited_unique && DB::table('user_inventory')->where('user_id', auth()->id())->where('asset_id', $asset->id)->exists();
        $creatorBcOverlay = match ((int) $asset->creator->membership) {
            1 => '/images/Icons/overlay_bcOnly.png', 2 => '/images/Icons/overlay_tbcOnly.png', 3 => '/images/Icons/overlay_obcOnly.png', default => null
        };
        $privateSales = collect();
        $bestPrivateSale = collect();
        $currentRap = 0;
        $priceGraphData = collect();
        $volumeGraphData = collect();
        $percentChange30 = 0;
        $percentChange90 = 0;
        $percentChange180 = 0;
        $volume30 = 0;
        $volume90 = 0;
        $volume180 = 0;
        $hasRapData = false;
        if ($asset->is_limited || $asset->is_limited_unique) {
            $privateSales = PrivateSale::with('seller')->where('asset_id', $asset->id)->orderBy('price')->orderBy('created_at')->paginate(10);
            $privateSales->withQueryString();
            $bestPrivateSale = PrivateSale::where('asset_id', $asset->id)->orderBy('price')->first();
            $currentRap = RecentAveragePrice::where('asset_id', $asset->id)->orderByDesc('created_at')->value('rap') ?? 0;
            $rapHistory = RecentAveragePrice::where('asset_id', $asset->id)->where('created_at', '>=', now()->subDays(180))->orderBy('created_at')->get(['rap', 'created_at']);
            $priceGraphData = $rapHistory->map(fn ($row) => [$row->created_at->timestamp * 1000, $row->rap])->values();
            $volumeByDay = RecentAveragePrice::where('asset_id', $asset->id)->where('created_at', '>=', now()->subDays(180))->selectRaw('DATE(created_at) as day, COUNT(*) as volume')->groupBy('day')->orderBy('day')->get();
            $volumeGraphData = $volumeByDay->map(fn ($row) => [Carbon::parse($row->day)->timestamp * 1000, (int) $row->volume])->values();
            $percentChange30 = $this->rapPercentChange($asset->id, $currentRap, 30);
            $percentChange90 = $this->rapPercentChange($asset->id, $currentRap, 90);
            $percentChange180 = $this->rapPercentChange($asset->id, $currentRap, 180);
            $volume30 = RecentAveragePrice::where('asset_id', $asset->id)->where('created_at', '>=', now()->subDays(30))->count();
            $volume90 = RecentAveragePrice::where('asset_id', $asset->id)->where('created_at', '>=', now()->subDays(90))->count();
            $volume180 = RecentAveragePrice::where('asset_id', $asset->id)->where('created_at', '>=', now()->subDays(180))->count();
            $hasRapData = $priceGraphData->isNotEmpty();
        }
        $userOwnedCopies = collect();
        if (($asset->is_limited || $asset->is_limited_unique) && auth()->check()) {
            $listedGuids = PrivateSale::where('asset_id', $asset->id)->where('user_id', auth()->id())->pluck('guid');
            $userOwnedCopies = Inventory::query()->where('user_id', auth()->id())->where('asset_id', $asset->id)->whereNotIn('guid', $listedGuids)->orderBy('serial_number')->get(['guid', 'serial_number']);
        }
        return view('item', array_merge(['title' => $asset->name.', a '.$asset->getTypeName().' by '.$asset->creator->username.' - Lunarix (updated '.$asset->updated_at->format('n/j/Y g:i:s A').')'], compact('asset', 'recommendations', 'userOwns', 'creatorBcOverlay', 'freeItems', 'privateSales', 'currentRap', 'priceGraphData', 'volumeGraphData', 'percentChange30', 'percentChange90', 'percentChange180', 'volume30', 'volume90', 'volume180', 'hasRapData', 'bestPrivateSale', 'userOwnedCopies')));
    }

    // note from sukaira: don't add this on routes or anywhere, it's related to item()
    private function rapPercentChange(int $assetId, int $currentRap, int $days): float
    {
        $pastRap = RecentAveragePrice::where('asset_id', $assetId)->where('created_at', '<=', now()->subDays($days))->orderByDesc('created_at')->value('rap');
        if (! $pastRap) {
            return 0.0;
        }
        return round((($currentRap - $pastRap) / $pastRap) * 100, 1);
    }
}
