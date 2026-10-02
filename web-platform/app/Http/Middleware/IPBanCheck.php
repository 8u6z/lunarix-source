<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IPBanCheck
{
    public function handle(Request $request, Closure $next): Response
    {
        $hashedIp = $request->attributes->get('hashed_ip');
        if ($hashedIp && DB::table('ip_bans')->where('ip_hash', $hashedIp)->exists()) {
            return response('You are not allowed to access this resource.', 200);
        }
        return $next($request);
    }
}