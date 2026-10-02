<?php
namespace App\Http\Controllers\Upload;
use App\Models\Videos\Video;
use App\Rules\IsActualVideoFile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use App\Http\Controllers\Controller;

class VideoUpload extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        $validated = $request->validate(['itemName' => ['required', 'string', 'max:50'], 'videoItem' => ['required', 'file', 'mimetypes:video/mp4', 'max:10240'], 'videoThumbItem' => ['nullable', 'file', 'mimetypes:image/png', 'max:2048']]);
        $video = Video::create(['name' => $validated['itemName'], 'video_path' => '', 'thumbnail_path' => null, 'creator_id' => $user->id, 'is_music' => false, 'visibility' => 1, 'aftwld_classic' => false, 'approval' => Video::APPROVAL_PENDING]);
        $videoHash = Str::random(24);
        $watermarkedTmp = tempnam(sys_get_temp_dir(), 'lvw_') . '.mp4';
        $watermarked = $this->applyWatermark($request->file('videoItem')->getRealPath(), $watermarkedTmp);
        if (!$watermarked) {
            $video->delete();
            @unlink($watermarkedTmp);
            return response()->json(['success' => false, 'message' => 'Failed to process video.'], 500);
        }
        $videoPath = "videos/{$video->id}/{$videoHash}.mp4";
        Storage::disk('videos')->put($videoPath, file_get_contents($watermarkedTmp));
        @unlink($watermarkedTmp);
        $thumbPath = null;
        if ($request->hasFile('videoThumbItem')) {
            $thumbHash = Str::random(24);
            $thumbPath = "videos/{$video->id}/thumbs/{$thumbHash}.png";
            $request->file('videoThumbItem')->storeAs("videos/{$video->id}/thumbs", "{$thumbHash}.png", 'videos');
        }
        $video->update(['video_path' => $videoPath, 'thumbnail_path' => $thumbPath]);
        return response()->json(['success' => true, 'id' => $video->id]);
    }

    private function applyWatermark(string $inputPath, string $outputPath): bool
    {
        $logoPath = config('app.video_watermark');
        if (!is_file($logoPath)) {
            return false;
        }
        $process = new Process([
            'ffmpeg',
            '-y',
            '-i', $inputPath,
            '-i', $logoPath,
            '-filter_complex', '[1:v]scale=iw*0.04:-1,format=rgba,colorchannelmixer=aa=0.5[wm];[0:v][wm]overlay=W-w-20:H-h-20',
            '-codec:a', 'copy',
            '-codec:v', 'libx264',
            '-preset', 'veryfast',
            '-crf', '23',
            $outputPath,
        ]);
        $process->setTimeout(300);
        $process->run();
        return $process->isSuccessful() && is_file($outputPath) && filesize($outputPath) > 0;
    }
}