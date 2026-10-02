<?php
namespace App\Models\Videos;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Video extends Model
{
    public const APPROVAL_PENDING = 0;
    public const APPROVAL_APPROVED = 1;
    public const APPROVAL_DENIED = 3;
    protected $fillable = ['name', 'description', 'video_path', 'creator_id', 'is_music', 'visibility', 'aftwld_classic', 'thumbnail_path', 'approval'];
    protected $casts = ['is_music' => 'boolean', 'visibility' => 'integer', 'aftwld_classic' => 'boolean', 'approval' => 'integer'];
    protected $appends = ['thumbnail_url', 'video_url', 'display_thumbnail_url'];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function views(): HasMany
    {
        return $this->hasMany(VideoViews::class);
    }
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('approval', self::APPROVAL_APPROVED);
    }
    public function isViewableBy(?int $userId): bool
    {
        if ($this->approval === self::APPROVAL_DENIED) {
            return false;
        }
        if ($this->approval === self::APPROVAL_PENDING) {
            return $userId !== null && $userId === $this->creator_id;
        }
        return true;
    }
    public function isOwnedBy(?int $userId): bool
    {
        return $userId !== null && $userId === $this->creator_id;
    }
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail_path ? Storage::disk('videos')->url($this->thumbnail_path) : null;
    }
    public function getVideoUrlAttribute(): ?string
    {
        return $this->video_path ? Storage::disk('videos')->url($this->video_path) : null;
    }
    public function getDisplayThumbnailUrlAttribute(): string
    {
        if ($this->approval === self::APPROVAL_PENDING) {
            return url('img/pending.png');
        }
        if ($this->approval === self::APPROVAL_DENIED) {
            return url('img/notapproved.png');
        }
        return $this->thumbnail_url ?? url('img/ph/placeholder.png');
    }
    public function needsReview(): bool
    {
        return $this->approval === self::APPROVAL_PENDING;
    }
    public function getTypeNameAttribute(): string
    {
        return 'Video';
    }
    public function scopeRequiresReview(Builder $query): Builder
    {
        return $query->where('approval', self::APPROVAL_PENDING)->orWhere('approval', self::APPROVAL_APPROVED)->orWhere('approval', self::APPROVAL_DENIED);
    }
}