<?php
namespace App\Http\Controllers\General\Frontend\Videos;
use App\Models\Videos\Video;
use App\Models\Videos\VideoViews;

class ViewVideo
{
    public function viewVideo($id)
    {
        $video = Video::with('creator')->findOrFail($id);
        $userId = auth()->id();
        if (! $video->isViewableBy($userId)) {
            abort(404);
        }
        if ($video->visibility == 0 && $userId !== $video->creator_id) {
            abort(404);
        }
        if ($userId && ! VideoViews::where('user_id', $userId)->where('video_id', $video->id)->exists()) {
            VideoViews::create(['user_id' => $userId, 'video_id' => $video->id]);
        }
        $video->loadCount('views');
        $otherVideos = Video::approved()->where('visibility', 1)->where('id', '!=', $video->id)->withCount('views')->latest()->take(10)->get();
        return view('videos.view', compact('video', 'otherVideos') + ['title' => $video->name . ' - Lunarix Videos']);
    }
}
