<?php
namespace App\Jobs;
use App\Http\Controllers\ArbiterController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
class Asset implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public int $timeout = 180;
    public int $tries = 1;
    public function __construct(public readonly int $assetId, public readonly bool $square = false)
    {
        $this->onQueue('asset');
    }
    public function handle(): void
    {
        $controller = new ArbiterController();
        $result = $controller->renderAsset($this->assetId, $this->square);
    }
    public function failed(\Throwable $e): void
    {
        Cache::forget("render_pending:asset:{$this->assetId}" . ($this->square ? ':square' : ''));
        \Log::error('whoopsies', ['assetId' => $this->assetId, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
    }
}