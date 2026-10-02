<?php
namespace App\Models\Groups;
use Illuminate\Database\Eloquent\Model;

class GroupRole extends Model
{
    public $timestamps = false;
    protected $fillable = ['group_id', 'role_name', 'description', 'rank', 'member_count'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function permissions()
    {
        return $this->hasOne(GroupRolePermission::class, 'role_id');
    }

    public function members()
    {
        return $this->hasMany(GroupUser::class, 'role_id');
    }
}