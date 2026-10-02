<?php
namespace App\Http\Controllers\RBXApis;
use App\Traits\AccessKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Asset
{
    use AccessKey;
    public function avatarFetch(Request $request)
    {
        $userId = $request->query('userId');
        if (! $userId) {
            return response('Missing userId', 400);
        }
        $urls = [];
        $urls[] = "http://lunarix.lol/Asset/BodyColors.ashx?userId={$userId}";
        $assets = DB::table('user_accoutrements')->where('user_id', $userId)->pluck('asset_id');
        foreach ($assets as $assetId) {
            if ($assetId > 0) {
                $urls[] = url("/asset/?id={$assetId}");
            }
        }
        return response(implode(';', $urls), 200)->header('Content-Type', 'text/plain');
    }

    public function serveAsset(Request $request)
    {
        $id = $request->query('id');
        if (! $id || ! ctype_digit((string) $id)) {
            return response()->json(['success' => 'false', 'message' => 'Invalid id.'], 422);
        }
        $asset = DB::selectOne('SELECT a.id, a.name, a.type, a.creator_id, a.access, a.approval, a.ghosted, av.path AS version_path FROM assets a INNER JOIN asset_versions av ON av.id = a.current_version_id WHERE a.id = ? LIMIT 1', [(int) $id]);
        if ($asset && !$this->isRCC($request) && (int) $asset->type === 9 && auth()->check() && (int) $asset->creator_id !== (int) auth()->id()) {
            return response()->json(['success' => 'false', 'message' => 'You do not own this place.'], 422);
        }
        if ($asset && ! in_array((int) $asset->type, [4, 9], true) && (int) $asset->approval !== 1) {
            return response()->json(['success' => 'false', 'message' => 'This asset does not exist.'], 422);
        }
        if ($asset && ! $asset->ghosted) {
            $filePath = ltrim($asset->version_path, '/');
            $disk = Storage::disk('asset');
            if ($disk->exists($filePath)) {
                $mimeType = $disk->mimeType($filePath) ?: 'application/octet-stream';
                $userAgent = $request->header('User-Agent', '');
                $isDiscord = str_contains(strtolower($userAgent), 'discordbot');
                $disposition = $isDiscord ? 'inline; filename="'.$asset->id.'"' : 'attachment; filename="'.$asset->id.'"';
                $stream = $disk->readStream($filePath);
                return response()->stream(
                    function () use ($stream) {
                        fpassthru($stream);
                        if (is_resource($stream)) {
                            fclose($stream);
                        }
                    }, 200, ['Content-Type' => $mimeType, 'Content-Disposition' => $disposition, 'Cache-Control' => 'public, max-age=31536000, immutable']);
            }
        }
        $robloxDisk = Storage::disk('asset_roblox');
        $robloxPath = (string) $id;
        if (! $robloxDisk->exists($robloxPath)) {
            $cookie = env('ROBLOX_SECURITY_COOKIE');
            $response = Http::timeout(15)->withHeaders(['User-Agent' => 'Roblox/WinInet', 'Cookie' => '.ROBLOSECURITY=' . $cookie])->get("https://assetdelivery.roblox.com/v1/asset/?id={$id}");
            if (! $response->successful()) {
                return response()->json(['success' => 'false', 'message' => 'Failed to fetch asset content.'], 422);
            }
            $robloxDisk->put($robloxPath, $response->body());
        }
        $mimeType = $robloxDisk->mimeType($robloxPath) ?: 'application/octet-stream';
        $stream = $robloxDisk->readStream($robloxPath);
        return response()->stream(
            function () use ($stream) {
                fpassthru($stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
            }, 200, ['Content-Type' => $mimeType, 'Content-Disposition' => 'attachment; filename="'.$id.'"', 'Cache-Control' => 'public, max-age=31536000, immutable']);
    }

    public function serveRobloxAsset(Request $request)
    {
        $id = $request->query('id');
        if (! $id || ! ctype_digit((string) $id)) {
            abort(400, 'Invalid asset ID.');
        }
        $disk = Storage::disk('asset_roblox');
        $filePath = $id;
        if (! $disk->exists($filePath)) {
            $cookie = env('ROBLOX_SECURITY_COOKIE');
            $response = Http::timeout(15)->withHeaders(['User-Agent' => 'Roblox/WinInet', 'Cookie' => '.ROBLOSECURITY=' . $cookie])->get("https://assetdelivery.roblox.com/v1/asset/?id={$id}");
            if (! $response->successful()) {
                abort(502, 'Failed to fetch asset from Roblox.');
            }
            $disk->put($filePath, $response->body());
        }
        $mimeType = $disk->mimeType($filePath) ?: 'application/octet-stream';
        $stream = $disk->readStream($filePath);
        return response()->stream(
            function () use ($stream) {
                fpassthru($stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
            }, 200, ['Content-Type' => $mimeType, 'Content-Disposition' => 'attachment; filename="'.$id.'"', 'Cache-Control' => 'public, max-age=31536000, immutable']);
    }
}