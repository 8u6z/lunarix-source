<?php
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Services\DiscordBot;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $users = User::all();
    $awarded = 0;
    $skipped = 0;
    foreach ($users as $user) {
        if ($user->last_reward_time && Carbon::parse($user->last_reward_time)->diffInHours(now()) < 24) {
            $skipped++;
            continue;
        }
        if ($user->membership === 0) {
            if (!$user->discord_id) {
                $skipped++;
                continue;
            }
            if (Carbon::parse($user->created_at)->diffInDays(now()) < 3) {
                $skipped++;
                continue;
            }
        }
        $user->increment('robux', $user->daily_robux);
        $user->update(['last_reward_time' => now()]);
        $awarded++;
    }
    info("Awarded stipeneds to {$awarded} users, {$skipped} skipped.");
})->dailyAt('00:00')->name('robux:daily');

Schedule::call(function (DiscordBot $discord) {
    User::whereNotNull('discord_id')->select(['id', 'discord_id', 'discord_username', 'discord_membership'])->chunkById(100, function ($users) use ($discord) {
        foreach ($users as $user) {
            try {
                $member = $discord->member((string) $user->discord_id);
                $level = $member ? $discord->boostLevel($member) : 0;
                $username = $member['user']['username'] ?? null;
                if ((int) $user->discord_membership !== $level || ($username && $user->discord_username !== $username)) {
                    User::whereKey($user->id)->update(['discord_membership' => $level, 'discord_username' => $username ?? $user->discord_username]);
                }
            } catch (\Throwable $e) {
                report($e);
            }
        }
    });
})->everyFiveMinutes()->name('discord:boost-membership')->withoutOverlapping();
