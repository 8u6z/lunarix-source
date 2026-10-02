<?php
namespace App\Models\Forums;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumThreadPost extends Model
{
    protected $table = 'forum_thread_posts';
    protected $fillable = ['content', 'thread_id', 'author_id'];
    public function thread(): BelongsTo
    {
        return $this->belongsTo(ForumThread::class, 'thread_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}