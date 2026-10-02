<?php
namespace App\Http\Controllers\General\Backend;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateItem
{
    public function updateItem(Request $request)
    {
        $validated = $request->validate(['id' => 'required|integer', 'name' => 'required|string|max:100', 'description' => 'nullable|string|max:1000', 'onsale' => 'nullable|boolean', 'price' => 'nullable|integer|min:0', 'can_comment' => 'nullable|boolean']);
        $asset = Asset::where('id', $validated['id'])->where('creator_id', Auth::id())->firstOrFail();
        $onsale = $request->boolean('onsale');
        $asset->update(['name' => $validated['name'], 'description' => $validated['description'] ?? '', 'onsale' => $onsale, 'robux' => $onsale ? ($validated['price'] ?? 0) : null, 'can_comment' => $request->boolean('can_comment')]);
        return response()->json(['success' => true, 'id' => $asset->id]);
    }
}
