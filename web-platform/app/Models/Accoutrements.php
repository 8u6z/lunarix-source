<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Accoutrement extends Model
{
    protected $table = 'user_accoutrements';
    public $timestamps = false;
    protected $fillable = ['user_id', 'asset_id', 'type'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}