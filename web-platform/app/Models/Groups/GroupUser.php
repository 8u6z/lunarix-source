<?php
namespace App\Models\Groups;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    public $timestamps = false;
    protected $fillable = ['group_id', 'role_id', 'user_id'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function role()
    {
        return $this->belongsTo(GroupRole::class, 'role_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}