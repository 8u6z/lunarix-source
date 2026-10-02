<?php
namespace App\Models\Forums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ForumGroup extends Model
{
    protected $table = 'forum_groups';
    protected $fillable = ['name'];
    public function forums(): HasMany
    {
        return $this->hasMany(Forum::class, 'forum_group_id');
    }
}