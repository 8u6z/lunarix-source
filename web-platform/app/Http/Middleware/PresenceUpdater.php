<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class PresenceUpdater
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()) {
            $request->user()->update(['last_activity' => now()]);
        }
        return $next($request);
    }
}