<?php
namespace App\Models\Videos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class VideoViews extends Model
{
    const UPDATED_AT = null;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['user_id', 'video_id'];
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}