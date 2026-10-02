<?php
namespace App\Http\Controllers\General\Backend\Renders;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AssetRender
{
    public function redirectAssetRender(Request $request)
    {
        $assetId = (int) $request->query('assetId');
        if (! $assetId) {
            return response()->json(['success' => false, 'error' => 'Missing assetId'], 400);
        }
        $isSquarePlace = $request->boolean('square');
        $cacheKey = "asset_render_url:{$assetId}:" . ($isSquarePlace ? 'square' : 'default');
        $cachedUrl = Cache::get($cacheKey);
        if ($cachedUrl !== null) {
            return redirect()->away($cachedUrl);
        }
        $url = $this->resolveAssetRenderUrl($assetId, $isSquarePlace, $request);
        $ttl = str_contains($url, 'placeholder') || str_contains($url, 'pending') ? now()->addSeconds(30) : now()->addMinutes(15);
        Cache::put($cacheKey, $url, $ttl);
        return redirect()->away($url);
    }

    private function resolveAssetRenderUrl(int $assetId, bool $isSquarePlace, Request $request): string
    {
        $placeholder = '/img/ph/user_placeholder.png';
        $notapproved = '/img/notapproved.png';
        $pending = '/img/pending.png';
        $asset = Asset::find($assetId);
        if (! $asset) {
            return $placeholder;
        }
        if ($asset->isUnderReview()) {
            return $pending;
        }
        if ($asset->isNotApproved()) {
            return $notapproved;
        }
        if (! $asset->isPubliclyAvailable()) {
            abort(404);
        }
        if (config('app.lunarix_renders_disabled', false)) {
            return $placeholder;
        }
        $isSquarePlace = $asset->type === Asset::TYPE_PLACE && $isSquarePlace;
        if ($asset->type === Asset::TYPE_IMAGE) {
            $version = DB::table('asset_versions')->where('asset_id', $assetId)->orderByDesc('created_at')->first();
            if (! $version) {
                return $placeholder;
            }
            $path = ltrim($version->path, '/');
            return "https://asset.lunarix.lol/{$path}";
        }
        if ($asset->type === Asset::TYPE_AUDIO) {
            return '/images/AudioPreview.png';
        }
        if (in_array($asset->type, [Asset::TYPE_LUA, Asset::TYPE_MODEL], true)) {
            return '/images/ModelPreview.png';
        }
        if (in_array($asset->type, [Asset::TYPE_FACE, Asset::TYPE_DECAL, Asset::TYPE_TSHIRT], true)) {
            if (! $asset->related_to) {
                return $placeholder;
            }
            return $this->resolveAssetRenderUrl($asset->related_to, $isSquarePlace, $request);
        }
        $cdnBase = rtrim(config('app.cdn_url', 'https://cdn.lunarix.lol'), '/');
        $renderQuery = DB::table('asset_renders')->where('asset_id', $assetId);
        $renderQuery = $isSquarePlace ? $renderQuery->where('render_type', 'place_square') : $renderQuery->where('render_type', '!=', 'place_square');
        $render = $renderQuery->orderByDesc('created_at')->first();
        if ($asset->type === Asset::TYPE_PLACE) {
            if ($render && (bool) $render->is_place_thumbnail) {
                $approvalColumn = $isSquarePlace ? 'thumbnail_square_approval' : 'thumbnail_approval';
                $approvalStatus = (int) $asset->{$approvalColumn};
                if ($approvalStatus === 0) {
                    return $pending;
                }
                if ($approvalStatus === 2) {
                    return $notapproved;
                }
                return "{$cdnBase}/" . $this->cleanRenderPath($render->render_path);
            }
            return $placeholder;
        }
        if ($render) {
            $createdAt = \Carbon\Carbon::parse($render->created_at, config('app.timezone'));
            if ($createdAt->greaterThanOrEqualTo(now()->subDays(7))) {
                return "{$cdnBase}/" . $this->cleanRenderPath($render->render_path);
            }
        }
        $lockKey = "render_pending:asset:{$assetId}" . ($isSquarePlace ? ':square' : '');
        if (! Cache::has($lockKey)) {
            Cache::put($lockKey, true, now()->addSeconds(180));
            \App\Jobs\Asset::dispatch($assetId, $isSquarePlace);
        }
        return $placeholder;
    }

    private function cleanRenderPath(string $path): string
    {
        $path = trim($path);
        $path = preg_replace('#^https?://[^/]+/#i', '', $path);
        $path = preg_replace('#^(?:Thumbs/)?synvo\.live/#i', '', $path);
        return ltrim($path, '/');
    }
}
