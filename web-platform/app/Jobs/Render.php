<?php
namespace App\Jobs;
use App\Http\Controllers\ArbiterController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
class Render implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public int $timeout = 180;
    public int $tries = 1;
    public function __construct(public readonly int $userId, public readonly int $rccVersion, public readonly string $type)
    {
        $this->onQueue('render');
    }
    public function handle(): void
    {
        \Log::info('called it', ['userId' => $this->userId, 'rccVersion' => $this->rccVersion, 'type' => $this->type]);
        $controller = new ArbiterController();
        $result = $controller->renderAvatar($this->userId, $this->rccVersion, $this->type);
        \Log::info('result', ['userId' => $this->userId, 'result' => $result]);
    }
    public function failed(\Throwable $e): void
    {
        Cache::forget("render_pending:{$this->userId}:{$this->type}");
        \Log::error('whoopsies', ['userId' => $this->userId, 'type' => $this->type, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
    }
}