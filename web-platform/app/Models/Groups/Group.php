<?php
namespace App\Models\Groups;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = true;
    protected $fillable = ['owner_id', 'locked', 'name', 'description', 'is_verified', 'is_staff_group', 'is_bc_only', 'icon_image_id'];
    protected $casts = ['locked' => 'boolean', 'is_verified' => 'boolean', 'is_staff_group' => 'boolean', 'is_bc_only' => 'boolean'];

    public function getIconUrlAttribute(): ?string
    {
        return $this->icon_image_id ? '/Thumbs/Asset.ashx?assetId='.$this->icon_image_id : null;
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function roles()
    {
        return $this->hasMany(GroupRole::class)->orderBy('rank', 'desc');
    }

    public function members()
    {
        return $this->hasMany(GroupUser::class);
    }

    public function settings()
    {
        return $this->hasOne(GroupSetting::class);
    }

    public function statuses()
    {
        return $this->hasMany(GroupStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(GroupStatus::class)->latestOfMany();
    }

    public function wallPosts()
    {
        return $this->hasMany(GroupWall::class)->where('deleted', false);
    }

    public function memberCount(): int
    {
        return $this->members()->count();
    }
}