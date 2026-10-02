<?php
namespace App\Models\Economy;
use Illuminate\Database\Eloquent\Model;

class PrivateSale extends Model
{
    protected $table = 'private_sales';
    public $timestamps = false;
    protected $fillable = ['user_id', 'asset_id', 'guid', 'serial', 'price', 'created_at'];
    protected $casts = ['created_at' => 'datetime'];
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}