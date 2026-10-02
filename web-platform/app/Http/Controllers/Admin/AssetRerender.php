<?php
namespace App\Http\Controllers\Admin;
use App\Models\Asset;
use App\Services\AdminAudit;
use App\Services\AssetRenderQueue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssetRerender
{
    public function index(): View
    {
        return view('admin.assets.rerender');
    }

    public function store(Request $request, AssetRenderQueue $renders): RedirectResponse
    {
        $validated = $request->validate(['asset_id' => ['required', 'integer', 'exists:assets,id']]);
        $asset = Asset::findOrFail((int) $validated['asset_id']);
        if ($asset->isPlace()) {
            return back()->withErrors(['asset_id' => 'Use game management for Place assets.'])->withInput();
        }
        if (! $renders->supports($asset)) {
            return back()->withErrors(['asset_id' => 'This asset type does not have an RCC render script.'])->withInput();
        }
        if ($asset->needsReview() && ! $asset->isPubliclyAvailable()) {
            return back()->withErrors(['asset_id' => 'Approve this asset before requesting a public re-render.'])->withInput();
        }
        if (! $renders->queue($asset, true)) {
            return back()->withErrors(['asset_id' => 'Rendering is disabled or the job could not be queued.'])->withInput();
        }
        AdminAudit::record('asset.rerender_queued', ['asset_id' => $asset->id, 'asset_type' => $asset->getTypeName()], $asset->creator_id, $request->user()->id);
        return back()->with('success', 'Asset '.$asset->id.' was queued for rendering.');
    }
}
