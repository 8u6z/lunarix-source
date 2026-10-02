<?php
namespace App\Http\Controllers\General\Frontend\Catalog;
use App\Models\Asset;
use Illuminate\Http\Request;

class Index
{
    public function catalog(Request $request)
    {
        $assets = Asset::accessories()->notGhosted()->publiclyAvailable()->onSale()->with('creator')->orderBy('created_at', 'desc')->paginate(22);
        return view('catalog', array_merge(['title' => 'Avatar Items, Virtual Avatars, Virtual Goods'], compact('assets')));
    }
}
