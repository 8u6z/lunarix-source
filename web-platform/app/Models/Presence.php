<?php
namespace App\Models;
use Carbon\Carbon;
use App\Models\Games\GamePlayer;

class Presence
{
    const OFFLINE = 0;
    const ONLINE = 1;
    const IN_GAME = 2;
    const IN_STUDIO = 3;
    const TIMEOUT_SECONDS = 90;
    public static $labels = [self::OFFLINE => 'Offline', self::ONLINE => 'Online', self::IN_GAME => 'InGame', self::IN_STUDIO => 'InStudio'];
    public static function resolve(User $user): int
    {
        if (!$user->last_activity) {
            return self::OFFLINE;
        }
        $stale = Carbon::parse($user->last_activity)->lt(now()->subSeconds(self::TIMEOUT_SECONDS));
        if ($stale) {
            return self::OFFLINE;
        }
        if (GamePlayer::where('user_id', $user->id)->exists()) {
            return self::IN_GAME;
        }
        return $user->presence_type ?: self::ONLINE;
    }

    public static function label(User $user): string
    {
        return self::$labels[self::resolve($user)];
    }
  
    public static function publicResolve(User $user, ?User $viewer = null): int
    {
        return self::resolve($user);
    }
}