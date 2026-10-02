<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    protected $table = 'promocodes';
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['code', 'expires_at', 'bytes_reward', 'assets_reward'];
    protected $casts = ['created_at' => 'datetime', 'expires_at' => 'datetime', 'bytes_reward' => 'integer', 'assets_reward' => 'array'];
    public function scopeActive(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        });
    }

    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    public function redemptions()
    {
        return $this->hasMany(PromocodeRedemption::class, 'code', 'code');
    }
}