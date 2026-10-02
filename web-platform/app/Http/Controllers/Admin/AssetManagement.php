<?php
namespace App\Http\Controllers\Admin;
use App\Models\Asset;
use App\Services\AdminAudit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AssetManagement
{
    public function index(Request $request): View
    {
        $query = trim((string) $request->query('q', ''));
        $assetsQuery = Asset::query()->where('type', '!=', Asset::TYPE_PLACE)->with('creator:id,username');
        if ($query !== '') {
            $assetsQuery->where(function ($builder) use ($query) {
                    if (ctype_digit($query)) {
                        $builder->orWhere('id', (int) $query);
                    }
                    $builder->orWhereRaw('LOWER(name) LIKE ?', ['%'.strtolower($query).'%']);
                })->orderByRaw('CASE WHEN LOWER(name) = ? THEN 0 ELSE 1 END', [strtolower($query)]);
        }
        return view('admin.assets.find', ['query' => $query, 'assets' => $assetsQuery->orderBy('id')->paginate(50)->withQueryString()]);
    }

    public function edit(Asset $asset): View
    {
        abort_if($asset->isPlace(), 404);
        $asset->load('creator:id,username');
        return view('admin.assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset): RedirectResponse
    {
        abort_if($asset->isPlace(), 404);
        if ($request->input('action') === 'content_deletion') {
            return $this->deleteContent($request, $asset);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'integer', 'min:0', 'max:2147483647'],
            'onsale' => ['nullable', 'boolean'],
            'can_comment' => ['nullable', 'boolean'],
            'is_limited' => ['nullable', 'boolean'],
            'limited_quantity' => ['nullable', 'required_if:is_limited,1', 'integer', 'min:1', 'max:2147483647'],
            'is_limited_unique' => ['nullable', 'boolean'],
        ]);
        $isLimited = $request->boolean('is_limited');
        $isLimitedUnique = $request->boolean('is_limited_unique');
        $limitedQuantity = $isLimited ? (int) $validated['limited_quantity'] : null;
        if ($isLimitedUnique && ! $isLimited) {
            throw ValidationException::withMessages(['is_limited_unique' => 'Unique items must also be limited.']);
        }
        if ($isLimited && $limitedQuantity < $asset->sales_count) {
            throw ValidationException::withMessages(['limited_quantity' => 'The limited quantity cannot be lower than the '.number_format($asset->sales_count).' copies already sold.']);
        }
        $before = $asset->only(['name', 'description', 'robux', 'onsale', 'can_comment', 'is_limited', 'is_limited_unique', 'limited_quantity']);
        $asset->update([
            'name' => $validated['name'],
            'description' => (string) ($validated['description'] ?? ''),
            'robux' => (int) $validated['price'],
            'onsale' => $request->boolean('onsale'),
            'can_comment' => $request->boolean('can_comment'),
            'is_limited' => $isLimited,
            'is_limited_unique' => $isLimitedUnique,
            'limited_quantity' => $limitedQuantity,
        ]);
        AdminAudit::record('asset.updated', ['asset_id' => $asset->id, 'before' => $before, 'after' => $asset->fresh()->only(array_keys($before))], $asset->creator_id, $request->user()->id);
        return redirect()->route('admin.assets.edit', $asset)->with('success', 'Asset information updated.');
    }

    private function deleteContent(Request $request, Asset $asset): RedirectResponse
    {
        abort_if($asset->isPlace(), 404);
        $request->validate(['delete_name' => ['nullable', 'boolean'], 'delete_description' => ['nullable', 'boolean'], 'delete_asset' => ['nullable', 'boolean']]);
        $deleteName = $request->boolean('delete_name');
        $deleteDescription = $request->boolean('delete_description');
        $deleteAsset = $request->boolean('delete_asset');
        if (! $deleteName && ! $deleteDescription && ! $deleteAsset) {
            throw ValidationException::withMessages(['content' => 'Select at least one piece of asset content to delete.']);
        }
        DB::transaction(function () use ($request, $asset, $deleteName, $deleteDescription, $deleteAsset) {
            $lockedAsset = Asset::query()->lockForUpdate()->findOrFail($asset->id);
            abort_if($lockedAsset->isPlace(), 404);
            $updates = [];
            if ($deleteName) {
                $updates['name'] = '[ Content Deleted ]';
            }
            if ($deleteDescription) {
                $updates['description'] = '[ Content Deleted ]';
            }
            if ($deleteAsset) {
                $updates['ghosted'] = true;
                $updates['onsale'] = false;
                $updates['can_comment'] = false;
                $updates['approval'] = 2;
            }
            $lockedAsset->update($updates);
            AdminAudit::record('asset.content_deleted', ['asset_id' => $lockedAsset->id, 'name_reset' => $deleteName, 'description_reset' => $deleteDescription, 'asset_deleted' => $deleteAsset], $lockedAsset->creator_id, $request->user()->id);
        });
        return redirect()->route('admin.assets.edit', $asset)->with('success', 'The selected asset content was deleted.');
    }
}
