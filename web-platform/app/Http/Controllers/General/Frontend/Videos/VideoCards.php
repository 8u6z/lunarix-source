<?php
namespace App\Http\Controllers\General\Frontend\Videos;
use App\Models\Videos\Video;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VideoCards
{
    public function videoCards(Request $request)
    {
        $sortFilter = (int) $request->query('SortFilter', 1);
        $timeFilter = (int) $request->query('TimeFilter', 0);
        $videoFilter = (int) $request->query('VideoFilter', 0);
        $startRows = max(0, (int) $request->query('StartRows', 0));
        $maxRows = min(100, max(1, (int) $request->query('MaxRows', 14)));
        $applyFilters = function (Builder $query) use ($videoFilter, $sortFilter) {
            $query->approved()->where('visibility', 1);
            if ($videoFilter === 1) {
                $query->where('is_music', false);
            } elseif ($videoFilter === 2) {
                $query->where('is_music', true);
            }
            if ($sortFilter === 8) {
                $query->where('aftwld_classic', true);
            }
            return $query;
        };
        $query = $applyFilters(Video::query());
        switch ($sortFilter) {
            case 16:
                $query->withCount('views')->inRandomOrder();
                break;
            case 8:
                $query->withCount('views')->latest();
                break;
            case 1:
            default:
                $since = match ($timeFilter) {
                    1 => now()->subDay(), 2 => now()->subWeek(), 3 => now()->subMonth(), default => null
                };
                if ($since) {
                    $query->withCount(['views as views_count' => function ($q) use ($since) {
                        $q->where('created_at', '>=', $since);
                    }]);
                } else {
                    $query->withCount('views');
                }
                $query->orderByDesc('views_count');
                break;
        }
        $videos = $query->skip($startRows)->take($maxRows)->get();
        $html = $videos->map(fn (Video $video) => view('extra.videocard', ['video' => $video])->render())->implode('');
        return response($html, 200)->header('Content-Type', 'text/html');
    }
}
