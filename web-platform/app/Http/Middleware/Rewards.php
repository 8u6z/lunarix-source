<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class Rewards
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $this->grantIfEligible(Auth::user());
        }
        return $next($request);
    }

    protected function grantIfEligible(User $user): void
    {
        $lastReward = $user->last_reward_time ? Carbon::parse($user->last_reward_time) : null;
        if ($lastReward && $lastReward->gt(Carbon::now()->subDay())) {
            return;
        }
        $amount = User::DAILY_ROBUX[$user->membership] ?? User::DAILY_ROBUX[0];
        $affected = DB::table('users')->where('id', $user->id)->where(function ($q) {
                $q->whereNull('last_reward_time')->orWhere('last_reward_time', '<=', Carbon::now()->subDay());
            })->update(['moons' => DB::raw("moons + {$amount}"), 'last_reward_time' => Carbon::now()]);
        if ($affected === 1) {
            $user->moons += $amount;
            $user->last_reward_time = Carbon::now();
        }
    }
}