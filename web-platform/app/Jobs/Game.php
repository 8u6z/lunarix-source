<?php
namespace App\Jobs;
use App\Http\Controllers\ArbiterController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
class Game implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public int $timeout = 180;
    public int $tries = 1;
    public function __construct(public readonly string $jobId, public readonly string $gameId, public readonly int $port, public readonly int $soapPort, public readonly int $creatorId)
    {
        $this->onQueue('game');
    }
    public function handle(): void
    {
        try {
            app(ArbiterController::class)->startGameServer($this->jobId, $this->gameId, $this->port, $this->soapPort, $this->creatorId);
        } catch (\Throwable $e) {
            \Log::error('whoopsies', ['jobId' => $this->jobId, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            throw $e;
        }
    }
    public function failed(\Throwable $e): void
    {
        Cache::forget("game_pending:{$this->jobId}");
        \Log::error('fail', ['jobId' => $this->jobId, 'gameId' => $this->gameId, 'creatorId' => $this->creatorId, 'error' => $e->getMessage()]);
    }
}