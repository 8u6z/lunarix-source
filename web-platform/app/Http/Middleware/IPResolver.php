<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class IPResolver
{
    public function handle(Request $request, Closure $next)
    {
        $realIp = $request->header('CF-Connecting-IP', $request->ip());
        $hashed = hash_hmac('sha256', $realIp, Config::get('app.key'));
        $request->attributes->set('hashed_ip', $hashed);
        if ($userId = Auth::id()) {
            $this->recordHashedIp($userId, $hashed);
        }
        return $next($request);
    }

    protected function recordHashedIp(int $userId, string $hashed): void
    {
        $existing = DB::table('users')->where('id', $userId)->value('ip_hashes');
        $hashes = $existing ? json_decode($existing, true) : [];
        if (!is_array($hashes)) {
            $hashes = [];
        }
        $now = now()->toDateTimeString();
        $found = false;
        foreach ($hashes as &$entry) {
            if (($entry['hash'] ?? null) === $hashed) {
                $entry['last_seen'] = $now;
                $found = true;
                break;
            }
        }
        unset($entry);
        if (!$found) {
            $hashes[] = ['hash' => $hashed, 'first_seen' => $now, 'last_seen' => $now];
        }
        DB::table('users')->where('id', $userId)->update(['ip_hashes' => json_encode($hashes)]);
    }
}