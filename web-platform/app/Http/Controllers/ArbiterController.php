<?php
namespace App\Http\Controllers;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ArbiterController extends Controller
{
    protected string $rccApiRenderBase;
    protected string $rccApiGameBase;
    protected string $rccApiGameKey;
    public function __construct()
    {
        $this->rccApiRenderBase = env('RCC_API_URL', 'http://127.0.0.1:3000');
        $this->rccApiGameBase = env('RCC_GAME_API_URL', 'http://127.0.0.1:3500');
        $this->rccApiGameKey = env('RCC_ACCESS_KEY');
    }

    public function render(Request $request)
    {
        $request->validate(['userId' => 'required|integer', 'rccVersion' => 'required|integer', 'type' => 'nullable|string|in:thumbnail,closeup']);
        $userId = (int) $request->input('userId');
        $rccVersion = (int) $request->input('rccVersion');
        $type = $request->input('type', 'thumbnail');
        return $this->renderAvatar($userId, $rccVersion, $type);
    }
 
    public function renderAvatar(int $userId, int $rccVersion, string $type = 'thumbnail'): ?string
    {
        $type = strtolower($type);
        if (! in_array($type, ['thumbnail', 'closeup'])) {
            $type = 'thumbnail';
        }
        $endpoint = "/player/{$type}";
        $response = Http::post("{$this->rccApiRenderBase}{$endpoint}", ['userId' => $userId, 'rccVersion' => $rccVersion]);
        if (! $response->successful()) {
            \Log::error('renderAvatar failed', ['userId' => $userId, 'status' => $response->status(), 'body' => $response->body()]);
            return null;
        }
        $r2Path = $response->json()['r2Path'] ?? null;
        if ($r2Path !== null) {
            DB::table('user_renders')->insert(['user_id' => $userId, 'render_path' => $r2Path, 'render_type' => $type, 'created_at' => now(), 'outdated' => false]);
        }
        return $r2Path;
    }
 
    public function renderAsset(int $assetId, bool $square = false): array
    {
        $asset = Asset::find($assetId);
        if (! $asset) {
            \Log::warning('not found', ['assetId' => $assetId]);
            return ['success' => false, 'error' => 'Asset not found'];
        }
        $typeMap = [
            Asset::TYPE_HAT => 'hat',
            Asset::TYPE_HEAD => 'head',
            Asset::TYPE_MESH => 'mesh',
            Asset::TYPE_MODEL => 'model',
            Asset::TYPE_PACKAGE => 'package',
            Asset::TYPE_PANTS => 'pants',
            Asset::TYPE_PLACE => 'place',
            Asset::TYPE_SHIRT => 'Shirt',
            Asset::TYPE_GEAR => 'gear'
        ];
        $assetType = $typeMap[$asset->type] ?? null;
        if ($square && $asset->type === Asset::TYPE_PLACE) {
            $assetType = 'place_square';
        }
        $lockKey = "render_pending:asset:{$assetId}".($square ? ':square' : '');
        if (! $assetType) {
            \Log::warning('no render script fount', ['assetId' => $assetId, 'type' => $asset->type]);
            Cache::forget($lockKey);
            return ['success' => false, 'error' => "No render script for type: {$asset->type}"];
        }
        try {
            $response = Http::timeout(150)->post("{$this->rccApiRenderBase}/asset/render", ['assetId' => (string) $assetId, 'assetType' => $assetType]);
            if (! $response->successful()) {
                \Log::error('error', ['assetId' => $assetId, 'status' => $response->status(), 'body' => $response->body()]);
                Cache::forget($lockKey);
                return ['success' => false, 'error' => $response->json('error', 'Unknown arbiter error')];
            }
            $r2Path = $response->json('r2Path');
            DB::table('asset_renders')->insert(['asset_id' => $assetId, 'asset_type' => $asset->type, 'render_path' => $r2Path, 'render_type' => $assetType, 'created_at' => now()]);
            Cache::forget($lockKey);
            \Log::info('stored', ['assetId' => $assetId, 'r2Path' => $r2Path]);
            return ['success' => true, 'r2Path' => $r2Path];
        } catch (\Throwable $e) {
            Cache::forget($lockKey);
            \Log::error('exception', ['assetId' => $assetId, 'error' => $e->getMessage()]);
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
 
    public function startGameServer(string $jobId, string $gameId, int $port, int $soapPort, int $creatorId): void
    {
        if (empty($this->rccApiGameKey)) {
            \Log::error('RCC_ACCESS_KEY is not configured; aborting game server start', ['jobId' => $jobId, 'gameId' => $gameId]);
            throw new \RuntimeException('RCC_ACCESS_KEY is not configured.');
        }
        $lockKey = "game_pending:asset:{$gameId}";
        if (! Cache::add($lockKey, $jobId, now()->addSeconds(30))) {
            \Log::warning('server start already pending for this place, ignoring', ['jobId' => $jobId, 'gameId' => $gameId]);
            return;
        }
        $existing = DB::table('game_servers')->where('asset_id', $gameId)->where('status', '!=', 0)->exists();
        if ($existing) {
            \Log::warning('server already running for this place, ignoring', ['jobId' => $jobId, 'gameId' => $gameId]);
            Cache::forget($lockKey);
            return;
        }
        try {
            $response = Http::withHeaders(['gsa-api-key' => $this->rccApiGameKey])->timeout(120)->get("{$this->rccApiGameBase}/gs/start", ['jobId' => $jobId, 'gameId' => $gameId, 'port' => $port, 'soapPort' => $soapPort, 'creatorId' => $creatorId]);
            if (! $response->successful() || $response->json('success') !== true) {
                throw new \RuntimeException($response->json('error') ?: 'RCC refused to start the server.');
            }
            $universeId = DB::table('assets')->where('id', $gameId)->value('universe_id');
            $maxCapacity = DB::table('assets')->where('id', $gameId)->value('max_players');
            DB::table('game_servers')->insert(['asset_id' => $gameId, 'universe_id' => $universeId, 'port' => $port, 'soap_port' => $soapPort, 'job_id' => $jobId, 'status' => 2, 'created_at' => now(), 'ip_address' => '38.87.116.238', 'capacity' => $maxCapacity ?? 8]);
        } catch (\Throwable $e) {
            \Log::error('whoopsies', ['jobId' => $jobId, 'error' => $e->getMessage()]);
            try {
                Http::withHeaders(['gsa-api-key' => $this->rccApiGameKey])->timeout(10)->get("{$this->rccApiGameBase}/gs/stop", ['jobId' => $jobId]);
            } catch (\Throwable $stopException) {
                \Log::error('failed to defensively stop possibly-orphaned job', ['jobId' => $jobId, 'error' => $stopException->getMessage()]);
            }
            throw $e;
        } finally {
            Cache::forget($lockKey);
        }
    }
}