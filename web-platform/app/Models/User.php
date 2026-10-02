<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Asset;
use App\Models\UserBody;
use App\Models\Inventory;
class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = ['username', 'password', 'description', 'birth_date', 'status', 'moons', 'last_activity', 'is_verified', 'is_kattus', 'gender', 'last_reward_time', 'discord_id', 'discord_username', 'discord_membership', 'membership'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['membership' => 'integer', 'discord_membership' => 'integer', 'discord_id' => 'string', 'last_activity' => 'datetime'];
    public static function isUsernameValid($username)
    {
        return (bool) preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username);
    }
    public static function isNameAvailableForSignup($username)
    {
        return !self::where('username', $username)->exists();
    }
    const MEMBERSHIP_NAMES = [0 => 'None', 1 => 'Bloxxers Club', 2 => 'Turbo Bloxxers Club', 3 => 'Outrageous Bloxxers Club'];
    const MEMBERSHIP_ICONS = [0 => null, 1 => 'lrx-icon-bc', 2 => 'lrx-icon-tbc', 3 => 'lrx-icon-obc'];
    const MEMBERSHIP_ICONS_SHORT = [0 => null, 1 => 'bc', 2 => 'tbc', 3 => 'obc'];
    const DAILY_ROBUX = [0 => 5, 1 => 15, 2 => 35, 3 => 60];
    const ROLESET_NAMES = [0 => 'Member', 1 => 'Asset Moderator', 2 => 'Moderator', 3 => 'Head Moderator', 4 => 'Admin', 5 => 'Head Admin', 6 => 'Developer', 7 => 'Founder'];
    public function getMembershipAttribute($value): int
    {
        return max((int) $value, (int) ($this->attributes['discord_membership'] ?? 0));
    }
    public function getBaseMembershipAttribute(): int
    {
        return (int) ($this->attributes['membership'] ?? 0);
    }
    public function getMembershipNameAttribute(): string
    {
        return self::MEMBERSHIP_NAMES[$this->membership] ?? 'None';
    }
    public function getMembershipIconAttribute(): ?string
    {
        return self::MEMBERSHIP_ICONS[$this->membership] ?? null;
    }
    public function getDailyRobuxAttribute(): int
    {
        return self::DAILY_ROBUX[$this->membership] ?? 5;
    }
    public function hasBC(): bool
    {
        return $this->membership >= 1;
    }
    public function hasTBC(): bool
    {
        return $this->membership >= 2;
    }
    public function hasOBC(): bool
    {
        return $this->membership >= 3;
    }
    public function getRolesetNameAttribute(): ?string
    {
        return self::ROLESET_NAMES[$this->roleset] ?? null;
    }
    public function isStaff(): bool
    {
        return $this->roleset > 0;
    }
    public function hasMinimumRole(int $roleset): bool
    {
        return $this->roleset >= $roleset;
    }
    public function hasRole(int $roleset): bool
    {
        return $this->roleset === $roleset;
    }
    public function wornAssets()
    {
        return $this->belongsToMany(Asset::class, 'user_accoutrements', 'user_id', 'asset_id');
    }
    public function body()
    {
        return $this->hasOne(UserBody::class, 'userid');
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'user_id');
    }
    public function markRendersOutdated(): void
    {
        \DB::table('user_renders')->where('user_id', $this->id)->update(['outdated' => true]);
    }
}
