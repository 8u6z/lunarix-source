<?php
namespace App\Http\Controllers\General\Frontend;
use App\Models\Asset;
use App\Models\Videos\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class Develop
{
    public function develop(Request $request): RedirectResponse|View
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/login');
        }
        $view = $request->query('View', '9');
        if ($view === null) {
            return redirect('/develop');
        }
        $namedViews = ['userads', 'videos'];
        if (in_array($view, $namedViews, true)) {
            $bladePath = "developviews.{$view}";
            if (! view()->exists($bladePath)) {
                return redirect('/develop');
            }
            if ($view === 'videos') {
                $videos = Video::where('creator_id', $user->id)->latest('updated_at')->get();
                return view('develop', ['contentView' => $bladePath, 'activeView' => $view, 'videos' => $videos, 'assets' => collect(), 'isGamesView' => false]);
            }
            if ($view === 'userads') {
                $userAds = DB::table('user_ads')->join('assets as ad_asset', 'user_ads.image_id', '=', 'ad_asset.id')->join('assets as target_asset', 'user_ads.target_id', '=', 'target_asset.id')->where('ad_asset.creator_id', $user->id)->orderByDesc('ad_asset.updated_at')->select('user_ads.id as ad_id', 'ad_asset.id as id', 'ad_asset.name as name', 'ad_asset.updated_at as updated_at', 'target_asset.id as target_id_val', 'target_asset.name as target_name', 'user_ads.impressions', 'user_ads.clicks', 'user_ads.bid_amount', 'user_ads.impressions_last_run', 'user_ads.clicks_last_run', 'user_ads.bid_amount_last_run')->get();
                $userAds->each(function ($row) {
                    $row->slug = Asset::slugify($row->name);
                    $row->target_slug = Asset::slugify($row->target_name);
                });
                return view('develop', ['contentView' => $bladePath, 'activeView' => $view, 'assets' => $userAds, 'isGamesView' => false]);
            }
            return view('develop', ['contentView' => $bladePath, 'activeView' => $view, 'assets' => collect(), 'isGamesView' => false]);
        }
        if (! ctype_digit((string) $view)) {
            return redirect('/develop');
        }
        $bladePath = "developviews.{$view}";
        if (!view()->exists($bladePath)) {
            return redirect('/develop');
        }
        $viewInt = (int) $view;
        $assets = Asset::where('creator_id', $user->id)->where('type', $viewInt)->notGhosted()->latest('updated_at')->get();
        return view('develop', ['title' => 'Develop - Lunarix', 'contentView' => $bladePath, 'activeView' => $viewInt, 'assets' => $assets, 'isGamesView' => $viewInt === Asset::TYPE_PLACE]);
    }
}
