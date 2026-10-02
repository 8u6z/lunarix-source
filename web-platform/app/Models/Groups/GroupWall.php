<?php
namespace App\Models\Groups;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GroupWall extends Model
{
    protected $table = 'group_wall';
    public $timestamps = true;
    protected $fillable = ['group_id', 'user_id', 'content', 'deleted'];
    protected $casts = ['deleted' => 'boolean'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}