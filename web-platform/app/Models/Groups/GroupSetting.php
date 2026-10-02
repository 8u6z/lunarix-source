<?php
namespace App\Models\Groups;
use Illuminate\Database\Eloquent\Model;

class GroupSetting extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'group_id';
    public $incrementing = false;
    protected $fillable = ['group_id', 'approval', 'enemies_allowed', 'funds_visible', 'games_visible'];
    protected $casts = ['approval' => 'boolean', 'enemies_allowed' => 'boolean', 'funds_visible' => 'boolean', 'games_visible' => 'boolean'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}