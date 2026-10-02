<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NoBypassBlud
{
    protected array $except = ['/', 'Setting/*', 'developer-apis/*', 'landing/signup', 'login',  'login/v1', 'Login/FulfillConstraint.aspx', 'Login/Negotiate.ashx', 'mobileapi/*', 'client-status/*', 'persistence/*'];
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->userAgent() ?? '';
        $isRobloxClient = str_contains($userAgent, 'Roblox');
        $isRobloxAndroidApp = str_contains($userAgent, 'ROBLOX Android App');
        if (!Auth::check() && !$isRobloxClient && !$isRobloxAndroidApp && !$this->isExcepted($request)) {
            return redirect('/');
        }
        return $next($request);
    }

    protected function isExcepted(Request $request): bool
    {
        foreach ($this->except as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }
        return false;
    }
}