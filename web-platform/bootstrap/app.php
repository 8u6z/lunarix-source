<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\MaintenanceGate;
use App\Http\Middleware\DetectIfBannedUser;
use App\Http\Middleware\NoBypassBlud;
use App\Http\Middleware\EnsureRoleset;
use App\Http\Middleware\PresenceUpdater;
use App\Http\Middleware\PBadge;
use App\Http\Middleware\Rewards;
use App\Http\Middleware\IPResolver;
use App\Http\Middleware\IPBanCheck;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        health: '/up',
        then: function () {
            Route::middleware('web')->group(base_path('routes/frontend.php'));
            Route::middleware('web')->group(base_path('routes/backend.php'));
            Route::middleware('web')->group(base_path('routes/rbx.php'));
            Route::middleware('web')->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo('/');
        $middleware->web(append: [IPResolver::class, IPBanCheck::class, MaintenanceGate::class, NoBypassBlud::class, DetectIfBannedUser::class, PresenceUpdater::class, Rewards::class]);
        $middleware->prepend(\Illuminate\Http\Middleware\HandleCors::class,);
        $middleware->alias(['resolve.ip' => IPResolver::class, 'role' => EnsureRoleset::class]);
        //js embedded or super super hard to counter hence why they need to not be csrf protected
        $middleware->validateCsrfTokens(except: ['Trade/*', '/', '/Game/*', '/promocodes/*', 'api/comments.ashx', 'AbuseReport/InGameChatHandler.ashx', 'abusereport/InGameChatHandler.ashx', 'voting/*', 'api/friends/*', 'api/friends/sendfriendrequest', 'api/friends/removefriend', 'api/friends/acceptfriendrequest', 'api/friends/declinefriendrequest', 'user/follow', 'user/request-friendship', 'api/user/unfollow', '/API/Item.ashx', 'Login/FulfillConstraint.aspx', 'mobileapi/*', 'login/v1', 'game/report-event', 'client-status/*', 'RCCApi/*', '/My/Money.aspx/*', 'api/anticheat/*', 'API/CreatePlace', '/persistence/*']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
            $exceptions->dontReport([\Illuminate\Session\TokenMismatchException::class, \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class]);
            $exceptions->render(function (Throwable $e, $request) {
            if ($request->expectsJson()) {
                return null;
            }
            if (config('app.debug')) {
                return null;
            }
            $ref = (string) Str::uuid();
            $code = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
            if (! is_int($code) || $code < 400 || $code > 599) {
                $code = 500;
            }

            return response()->view('ldef', ['code' => $code, 'ref' => $ref], $code);
        });
    })->create();
