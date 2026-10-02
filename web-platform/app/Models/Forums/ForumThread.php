<?php
namespace App\Models\Forums;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ForumThread extends Model
{
    protected $table = 'forum_threads';
    protected $fillable = ['author_id', 'subject', 'views', 'forum_id', 'is_pinned', 'is_locked'];
    protected $casts = ['views' => 'integer', 'is_pinned' => 'boolean', 'is_locked' => 'boolean'];
    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class, 'forum_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(ForumThreadPost::class, 'thread_id');
    }

    public function firstPost(): HasOne
    {
        return $this->hasOne(ForumThreadPost::class, 'thread_id')->oldestOfMany();
    }

    public function latestPost(): HasOne
    {
        return $this->hasOne(ForumThreadPost::class, 'thread_id')->latestOfMany();
    }
}