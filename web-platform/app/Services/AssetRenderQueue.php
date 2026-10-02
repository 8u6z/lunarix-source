<?php

namespace App\Services;

use App\Jobs\Asset as AssetRenderJob;
use App\Models\Asset;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AssetRenderQueue
{
    private const RENDERABLE_TYPES = [
        Asset::TYPE_HAT, Asset::TYPE_HEAD, Asset::TYPE_MESH,
        Asset::TYPE_MODEL, Asset::TYPE_PACKAGE, Asset::TYPE_PANTS,
        Asset::TYPE_PLACE, Asset::TYPE_SHIRT, Asset::TYPE_GEAR,
    ];

    public function supports(Asset $asset): bool
    {
        return in_array($asset->type, self::RENDERABLE_TYPES, true);
    }

    public function queue(Asset $asset, bool $force = false, bool $square = false): bool
    {
        if (config('app.lunarix_renders_disabled', false) || ! $this->supports($asset)) {
            return false;
        }
        $lockKey = "render_pending:asset:{$asset->id}".($square ? ':square' : '');
        if ($force) {
            Cache::forget($lockKey);
        }
        if (! Cache::add($lockKey, true, now()->addSeconds(180))) {
            return true;
        }

        try {
            AssetRenderJob::dispatch($asset->id, $square);

            return true;
        } catch (\Throwable $exception) {
            Cache::forget($lockKey);
            Log::error('Failed to queue asset render', ['asset_id' => $asset->id, 'exception' => $exception]);

            return false;
        }
    }
}
