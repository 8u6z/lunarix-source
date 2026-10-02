<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\AuthController;

class DetectIfBannedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $authController = app(AuthController::class);
        $currentUser = $authController->getAuthenticatedUser($request);
        if (!$currentUser) {
            return $next($request);
        }
        $bypassRoutes = ['membership.suspended', 'membership.reactivate', 'logout', 'terms', 'appeal.submit', 'support.contact', 'cssfetch'];
        $bypassPaths = ['authentication/logout', 'CSS/*', 'info/terms-of-service'];
        $routeName = optional($request->route())->getName();
        if ($routeName && in_array($routeName, $bypassRoutes, true)) {
            return $next($request);
        }
        foreach ($bypassPaths as $pattern) {
            if ($request->is($pattern)) {
                return $next($request);
            }
        }
        if ((int) $currentUser->status === 1) {
            return $next($request);
        }
        if (in_array((int) $currentUser->status, [2, 6], true)) {
            $authController->logout($request);
            return redirect('/login');
        }
        return redirect()->route('membership.suspended');
    }
}
