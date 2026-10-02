<?php
namespace App\Http\Controllers\General\Backend\Games;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoreResults
{
    public function moreResultsCached(Request $request)
    {
        $startRows = max((int) $request->input('StartRows', 0), 0);
        $maxRows = min(max((int) $request->input('MaxRows', 40), 1), 200);
        $keyword = trim((string) $request->input('Keyword', ''));
        $sortFilter = (int) $request->input('SortFilter', 1);
        $ratingTotals = DB::table('rates')->select('asset_id')->selectRaw('SUM(CASE WHEN rate_type = 1 THEN 1 ELSE 0 END) as likes_count')->selectRaw('SUM(CASE WHEN rate_type = 2 THEN 1 ELSE 0 END) as dislikes_count')->selectRaw('COUNT(*) as ratings_count')->groupBy('asset_id');
        $query = Asset::places()->notGhosted()->select('assets.*')->selectRaw('COALESCE(rating_totals.likes_count, 0) as likes_count')->selectRaw('COALESCE(rating_totals.dislikes_count, 0) as dislikes_count')->selectRaw('COALESCE(rating_totals.ratings_count, 0) as ratings_count')->leftJoinSub($ratingTotals, 'rating_totals', function ($join) {
                $join->on('rating_totals.asset_id', '=', 'assets.id');
            })->with('creator')->withCount('gamePlayers')->where('access', 1);
        if ($keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }
        switch ($sortFilter) {
            case 1:
                $query->orderByDesc('game_players_count')->orderByDesc('visits')->orderByDesc('id');
                break;
            case 8:
                $query->where('staff_picks', true)->orderByDesc('id');
                break;
            case 14:
                $query->where('lunarix_classic', true)->orderByDesc('id');
                break;
            case 11:
                $query->orderByRaw('CASE WHEN COALESCE(rating_totals.ratings_count, 0) > 0 THEN 1 ELSE 0 END DESC')->orderByRaw('CASE WHEN COALESCE(rating_totals.ratings_count, 0) > 0 THEN CAST(COALESCE(rating_totals.likes_count, 0) AS REAL) / rating_totals.ratings_count ELSE 0 END DESC')->orderByDesc('ratings_count')->orderByDesc('likes_count')->orderByDesc('id');
                break;
            case 16:
                $query->inRandomOrder();
                break;
            default:
                $query->orderByDesc('id');
                break;
        }
        $games = $query->skip($startRows)->take($maxRows)->get();
        return response()->view('extra.gamecard', ['games' => $games])->header('Content-Type', 'text/html');
    }
}
