<?php
namespace App\Models\Groups;
use Illuminate\Database\Eloquent\Model;

class GroupRolePermission extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'role_id';
    public $incrementing = false;
    protected $fillable = [
        'role_id', 'delete_wall_posts', 'can_wall_post', 'post_to_group_status', 'kick_members', 'ban_members',
        'view_status', 'view_wall', 'change_users_rank', 'advertise', 'manage_allies', 'add_group_games',
        'view_group_logs', 'create_items', 'manage_items', 'spend_funds', 'manage_clan', 'manage_group_games',
    ];
    protected $casts = [
        'delete_wall_posts' => 'boolean', 'can_wall_post' => 'boolean', 'post_to_group_status' => 'boolean',
        'kick_members' => 'boolean', 'ban_members' => 'boolean', 'view_status' => 'boolean', 'view_wall' => 'boolean',
        'change_users_rank' => 'boolean', 'advertise' => 'boolean', 'manage_allies' => 'boolean',
        'add_group_games' => 'boolean', 'view_group_logs' => 'boolean', 'create_items' => 'boolean',
        'manage_items' => 'boolean', 'spend_funds' => 'boolean', 'manage_clan' => 'boolean', 'manage_group_games' => 'boolean',
    ];

    public function role()
    {
        return $this->belongsTo(GroupRole::class, 'role_id');
    }
}