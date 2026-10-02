<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceGate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    protected array $bypassExtensions = [
        'png','jpg','jpeg','gif','webp','svg',
        'css','js','ico','woff','woff2','ttf','map'
    ];

    protected array $bypassRoutes = [
        'maintenance',
        'maintenance.unlock',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (!config('app.maintenance_mode')) {
            return $next($request);
        }
        $ext = pathinfo($request->path(), PATHINFO_EXTENSION);
        if ($ext && in_array(strtolower($ext), $this->bypassExtensions, true)) {
            return $next($request);
        }
        if ($request->route() && in_array($request->route()->getName(), $this->bypassRoutes, true)) {
            return $next($request);
        }
        if (str_starts_with($request->path(), 'CSS/Base/CSS/FetchCSS') || str_starts_with($request->path(), 'Login/FulfillConstraint.aspx') || str_starts_with($request->path(), 'asset') || str_starts_with($request->path(), 'developer-apis/player-count') || str_starts_with($request->path(), 'Asset')) {
            return $next($request);
        }
        $cookieHash = $request->cookie('security_mntnb') ?? ($_COOKIE['security_mntnb'] ?? null);
        $key = trim(config('app.maintenance_key'));
        if ($cookieHash && hash_equals(hash('sha256', $key), trim($cookieHash))) {
            return $next($request);
        }
        return response()->view('maintenance', [], 503);
    }
}