<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class EnsureRoleset
{
    public function handle(Request $request, Closure $next, int $roleset): Response
    {
        if (!$request->user() || !$request->user()->hasMinimumRole($roleset)) {
            abort(404);
        }
        return $next($request);
    }
}