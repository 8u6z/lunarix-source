<?php
namespace App\Http\Controllers\General\Backend\Renders;
use App\Jobs\Render;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserRender
{
    public function redirectRender(Request $request, string $renderType)
    {
        $placeholder = '/img/ph/user_placeholder.png';
        if (config('app.lunarix_renders_disabled', false)) {
            return redirect()->away($placeholder);
        }
        $userId = (int) $request->query('userId');
        if (! $userId) {
            return response()->json(['success' => false, 'error' => 'Missing userId'], 400);
        }
        $typeMap = ['avatar' => 'thumbnail', 'headshot' => 'closeup'];
        $renderTypeKey = strtolower($renderType);
        if (! isset($typeMap[$renderTypeKey])) {
            return response()->json(['success' => false, 'error' => 'Invalid render type'], 400);
        }
        $mappedType = $typeMap[$renderTypeKey];
        $latest = DB::table('user_renders')->where('user_id', $userId)->where('render_type', $mappedType)->orderByDesc('created_at')->first();
        $isStale = $latest ? \Carbon\Carbon::parse($latest->created_at, config('app.timezone'))->lessThan(now()->subDays(7)) : true;
        $isOutdated = $latest ? (bool) $latest->outdated : true;
        $needsNewRender = ! $latest || $isOutdated || $isStale;
        if ($needsNewRender) {
            $lockKey = "render_pending:{$userId}:{$mappedType}";
            if (! Cache::has($lockKey)) {
                Cache::put($lockKey, true, now()->addSeconds(180));
                Render::dispatch($userId, 2015, $mappedType);
            }
        }
        if (! $latest || $isOutdated || $isStale) {
            return redirect()->away($placeholder);
        }
        $render = $latest;
        $path = trim($render->render_path);
        $path = preg_replace('#^https?://[^/]+/#i', '', $path);
        $path = preg_replace('#^(?:Thumbs/)?synvo\.live/#i', '', $path);
        $path = ltrim($path, '/');
        $disk = Storage::disk('renders');
        if (! $disk->exists($path)) {
            return redirect()->away($placeholder);
        }
        $imageData = $disk->get($path);
        $targetW = $request->query('x') !== null ? (int) $request->query('x') : null;
        $targetH = $request->query('y') !== null ? (int) $request->query('y') : null;
        if ($targetW === null || $targetH === null) {
            $mime = $disk->mimeType($path) ?: 'image/png';
            return response($imageData, 200)->header('Content-Type', $mime)->header('Cache-Control', 'public, max-age=86400')->header('X-Render-Path', $path);
        }
        $src = imagecreatefromstring($imageData);
        if ($src === false) {
            return redirect()->away($placeholder);
        }
        $srcW = imagesx($src);
        $srcH = imagesy($src);
        $dst = imagecreatetruecolor($targetW, $targetH);
        imagealphablending($dst, false);
        imagesavealpha($dst, true);
        imagefill($dst, 0, 0, imagecolorallocatealpha($dst, 0, 0, 0, 127));
        if ($renderTypeKey === 'headshot') {
            $cropW = 200;
            $cropH = 200;
            $offsetX = 390;
            $offsetY = 130;
            $srcX = max(0, $offsetX - ($cropW / 2));
            $srcY = max(0, $offsetY);
            $dstX = max(0, -$offsetX);
            $dstY = max(0, -$offsetY);
            $copyW = min($cropW - abs($dstX), $srcW - $srcX);
            $copyH = min($cropH - abs($dstY), $srcH - $srcY);
            imagecopyresampled($dst, $src, $dstX, $dstY, $srcX, $srcY, $copyW, $copyH, $copyW, $copyH);
        } else {
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $targetW, $targetH, $srcW, $srcH);
        }
        ob_start();
        imagepng($dst);
        $imageData = ob_get_clean();
        imagedestroy($src);
        imagedestroy($dst);
        return response($imageData, 200)->header('Content-Type', 'image/png')->header('Cache-Control', 'public, max-age=86400')->header('X-Render-Path', $path);
    }
}
