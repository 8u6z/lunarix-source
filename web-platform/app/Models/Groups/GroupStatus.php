<?php
namespace App\Models\Groups;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GroupStatus extends Model
{
    protected $table = 'group_status';
    public $timestamps = true;
    protected $fillable = ['group_id', 'user_id', 'status'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}