<?php
namespace App\Http\Controllers\RBXApis\Videos;
use App\Models\Videos\Video;
use Illuminate\Http\Request;

class VideoV1
{
    public function fetch(Request $request, $id)
    {
        $video = Video::with('creator')->findOrFail($id);
        if ($video->visibility == 0) {
            abort(404);
        }
        if ($video->visibility !== 1) {
            abort(404);
        }
        $location = $video->video_url;
        if (!$location) {
            abort(404);
        }
        return response()->json(['location' => $location]);
    }
}