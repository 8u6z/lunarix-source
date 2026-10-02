<?php
namespace App\Http\Controllers\RBXApis\Thumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Batch
{
    public function getBatch(Request $request)
    {
        if (config('app.lunarix_renders_disabled', false)) {
            return response()->json(["data" => []]);
        }
        $items = $request->json()->all();
        if (!is_array($items)) {
            return response()->json(["errors" => [["code" => 1, "message" => "Invalid payload"]]], 400);
        }
        $cdnBase = rtrim(config('app.cdn_url'), '/');
        $results = [];
        foreach ($items as $item) {
            $userId = $item['targetId'] ?? null;
            $type = $item['type'] ?? null;
            if (!$userId || !$type) {
                $results[] = [
                    "requestId" => $item['requestId'] ?? null,
                    "errorCode" => 4,
                    "errorMessage" => "The requested Ids are invalid, of an invalid type or missing.",
                    "targetId" => $userId,
                    "state" => "Error",
                    "imageUrl" => null,
                    "version" => null
                ];
                continue;
            }
            $renderType = match ($type) {
                'AvatarHeadShot' => 'closeup',
                'Avatar' => 'thumbnail',
                default => null
            };
            if (!$renderType) {
                $results[] = [
                    "requestId" => $item['requestId'],
                    "errorCode" => 4,
                    "errorMessage" => "Invalid type",
                    "targetId" => $userId,
                    "state" => "Error",
                    "imageUrl" => null,
                    "version" => null
                ];
                continue;
            }
            $render = DB::table('user_renders')->where('user_id', $userId)->where('render_type', $renderType)->orderByDesc('created_at')->first();
            if ($render) {
                $createdAt = Carbon::parse($render->created_at);
                if ($createdAt->greaterThanOrEqualTo(now()->subDays(7))) {
                    $path = ltrim(preg_replace('#^https?://[^/]+#', '', $render->render_path), '/');
                    $results[] = [
                        "requestId" => $item['requestId'],
                        "errorCode" => 0,
                        "errorMessage" => "",
                        "targetId" => $userId,
                        "state" => "Completed",
                        "imageUrl" => "{$cdnBase}/{$path}",
                        "version" => "TN3"
                    ];
                    continue;
                }
            }
            $results[] = [
                "requestId" => $item['requestId'],
                "errorCode" => 0,
                "errorMessage" => "",
                "targetId" => $userId,
                "state" => "Completed",
                "imageUrl" => "/img/ph/neuro.jpg",
                "version" => "TN3"
            ];
        }
        //seriously???
        return response()->json(["data" => $results]);
    }
}