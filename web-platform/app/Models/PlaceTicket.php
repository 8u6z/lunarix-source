<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceTicket extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'ticket', 'created_at', 'expires_at'];
    protected $casts = ['expires_at' => 'datetime'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}