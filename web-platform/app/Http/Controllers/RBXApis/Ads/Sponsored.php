<?php
namespace App\Http\Controllers\RBXApis\Ads;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Sponsored extends Controller
{
    public function get()
    {
        $pages = DB::table('sponsored_pages')->select('name', 'title', 'logo_image_url', 'page_path')->get();
        return response()->json([
            "data" => $pages->map(function ($page) {
                return ["name" => $page->name, "title" => $page->title, "logoImageUrl" => $page->logo_image_url, "pageType" => "Sponsored", "pagePath" => $page->page_path,];
            })
        ]);
    }
}