<?php
namespace App\Http\Controllers\Upload\Concerns;
use App\Models\Asset;
use App\Models\Inventory;
use App\Models\AssetVersion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait PersistsAssets
{
    protected function reserveAsset(int $creatorId, int $type): Asset
    {
        return Asset::create([
            'creator_id' => $creatorId,
            'type' => $type,
            'name' => '',
            'description' => '',
            'access' => 0,
            'can_comment' => true,
            'onsale' => false,
            'sales_count' => 0,
            'current_version_id' => null,
            'universe_id' => null,
            'ghosted' => false,
            'robux' => 0,
            'visits' => 0,
			'universe_id' => 0,
            'max_players' => 8,
            'genres' => null,
            'gear_types' => null,
            'related_to' => null,
			'created_at' => now(),
        ]);
    }
    protected function uploadAssetVersion(Asset $asset, string $contents): AssetVersion
    {
        $hash = hash('sha256', $contents);
        $relativePath = "/{$asset->id}/{$hash}";
        Storage::disk('asset')->put($relativePath, $contents);
        return AssetVersion::create([
            'asset_id' => $asset->id,
            'path' => $relativePath,
			'created_at' => now(),
        ]);
    }
    protected function finalizeAsset(Asset $asset, AssetVersion $version, string $name, array $extra = []): Asset
    {
        $asset->name = $name;
        $asset->description = $extra['description'] ?? '';
        $asset->access = $extra['access'] ?? 1;
        $asset->can_comment = $extra['can_comment'] ?? true;
        $asset->universe_id = $extra['universe_id'] ?? 0;
        $asset->genres = $extra['genres'] ?? null;
        $asset->gear_types = $extra['gear_types'] ?? null;
        $asset->related_to = $extra['related_to'] ?? null;
        $asset->current_version_id = $version->id;
        $asset->save();
        return $asset->fresh();
    }
    protected function addToInventory(int $userId, Asset $asset): Inventory
    {
        return Inventory::create(['user_id' => $userId, 'asset_id' => $asset->id, 'asset_type' => $asset->type, 'obtained_at' => now()]);
    }
    protected function storeAsset(int $creatorId, int $type, string $name, string $contents, array $extra = []): Asset
    {
        return DB::transaction(function () use ($creatorId, $type, $name, $contents, $extra) {
            $asset = $this->reserveAsset($creatorId, $type);
            $version = $this->uploadAssetVersion($asset, $contents);
            $finalized = $this->finalizeAsset($asset, $version, $name, $extra);
            $this->addToInventory($creatorId, $finalized);
            return $finalized;
        });
    }
}