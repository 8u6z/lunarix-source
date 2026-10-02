<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromocodeRedemption extends Model
{
    protected $table = 'promocode_redemptions';
    public $timestamps = false;
    protected $fillable = ['user_id', 'code', 'redeemed_at'];
    protected $casts = ['redeemed_at' => 'datetime'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function promocode(): BelongsTo
    {
        return $this->belongsTo(Promocode::class, 'code', 'code');
    }
}