<?php
namespace App\Models\Groups;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GroupClanMember extends Model
{
    public $timestamps = false;
    protected $fillable = ['group_id', 'user_id'];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}