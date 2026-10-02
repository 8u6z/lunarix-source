<?php
namespace App\Models\Forums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Forum extends Model
{
    protected $table = 'forums';
    protected $fillable = ['name', 'description', 'forum_group_id'];
    public function group(): BelongsTo
    {
        return $this->belongsTo(ForumGroup::class, 'forum_group_id');
    }

    public function threads(): HasMany
    {
        return $this->hasMany(ForumThread::class, 'forum_id');
    }

    public function posts(): HasManyThrough
    {
        return $this->hasManyThrough(ForumThreadPost::class, ForumThread::class, 'forum_id', 'thread_id', 'id', 'id');
    }
}