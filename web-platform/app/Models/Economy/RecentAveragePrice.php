<?php
namespace App\Models\Economy;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class RecentAveragePrice extends Model
{
    protected $table = 'recent_average_price';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;
    protected $fillable = ['asset_id', 'rap', 'created_at'];
    protected $casts = ['created_at' => 'datetime'];
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}