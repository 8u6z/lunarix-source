<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Alert;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Event;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Discord\DiscordExtendSocialite;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    RateLimiter::for('timeout', function (Request $request) {
        $key = $request->attributes->get('hashed_ip');
        return Limit::perMinute(5)->by($key)->response(function (Request $request, array $headers) {
            return response()->json(['message' => 'Too many requests, try again later.'], 429, $headers);
        });
    });
    Paginator::useBootstrapFive();
    Event::listen(SocialiteWasCalled::class, DiscordExtendSocialite::class);
    View::composer("*", function ($view) {
      $authController = app(AuthController::class);
      $currentUser = $authController->getAuthenticatedUser(request());
      $latestAlert = Alert::where("isvisible", true)->latest()->first();
      $profileUser = $view->getData()["userprofile"] ?? null;
      $friendRequestsCount = 0;
      if ($currentUser) {
        $friendRequestsCount = DB::table("friend_requests")->where("user_id_two", $currentUser->id)->count();
      }
      if (!$profileUser) {
        $profileUser = $currentUser;
      }
      $currentPresenceLabel = $profileUser ? Presence::label($profileUser) : 'Offline';
      $user = Auth::user();
      if (!$user) {
        $view->with("friends", collect());
        $view->with("latestAlert", $latestAlert);
        return;
      }
      $friends = DB::table("friends")->where("user_id_one", $user->id)->orWhere("user_id_two", $user->id)->get();
      $friendIds = $friends->map(function ($row) use ($user) {
        return $row->user_id_one == $user->id ? $row->user_id_two : $row->user_id_one;
      });
      $friendUsers = DB::table("users")->whereIn("id", $friendIds)->get();
      if (!$user) {
          $view->with("friends", collect());
          $view->with("latestAlert", $latestAlert);
          $view->with("currentUser", $currentUser);
          $view->with("friendRequestsCount", $friendRequestsCount);
          return;
      }
      $unreadMessagesCount = $currentUser ? DB::table('user_messages')->where('user_id', $currentUser->id)->where('is_system_message', false)->where('is_read', false)->where('is_archived', false)->count() : 0;
      $view->with(["friends" => $friendUsers, "blogNews" => $this->getBlogNews(), "currentUser" => $currentUser, "user" => $profileUser, "latestAlert" => $latestAlert, "currentPresenceLabel" => $currentPresenceLabel, "friendRequestsCount" => $friendRequestsCount, "unreadMessagesCount" => $unreadMessagesCount]);
    });
    Request::macro('isAndroidApp', function () {
        return str_contains($this->userAgent() ?? '', 'ROBLOX Android App');
    });
    Blade::if('role', fn (int $roleset) => auth()->user()?->hasMinimumRole($roleset) ?? false);
  }
  
  private function getBlogNews(int $limit = 5): array
  {
      return Cache::remember('blog_news', now()->addMinutes(15), function () use ($limit) {
          $response = Http::timeout(5)->get('https://blog.lunarix.pw/wp-json/wp/v2/posts', ['per_page' => $limit, '_fields' => 'id,title,link,date']);
          return $response->failed() ? [] : $response->json();
      });
  }
}