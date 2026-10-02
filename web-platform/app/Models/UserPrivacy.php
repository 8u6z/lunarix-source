<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserPrivacy extends Model
{
    protected $table = 'user_privacy';
    public $incrementing = false;
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'ChatPrivacy', 'GuestMode', 'PrivateMessagePrivacy', 'FollowMePrivacy', 'FriendMePrivacy', 'discord_notifications'];
    protected $casts = ['discord_notifications' => 'boolean'];
    const CHAT_NORMAL = 0;
    const CHAT_SUPER_SAFE = 1;
    const CHAT_PRIVACY_MAP = ['Normal' => self::CHAT_NORMAL, 'SuperSafeChat' => self::CHAT_SUPER_SAFE];
    const GUEST_DISABLED = 0;
    const GUEST_ENABLED = 1;
    const GUEST_MODE_MAP = ['Disabled' => self::GUEST_DISABLED, 'Enabled' => self::GUEST_ENABLED];
    const SCOPE_NOONE = 0;
    const SCOPE_FRIENDS = 1;
    const SCOPE_ALL = 2;
    const SCOPE_MAP = ['All' => self::SCOPE_ALL, 'Friends' => self::SCOPE_FRIENDS, 'Noone' => self::SCOPE_NOONE];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
