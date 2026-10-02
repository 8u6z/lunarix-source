<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;

class Ad extends Model
{
    protected $table = 'user_ads';
    protected $fillable = ['target_id', 'type', 'asset_id', 'image_id', 'bid_amount', 'impressions', 'clicks', 'impressions_last_run', 'clicks_last_run', 'bid_amount_last_run'];
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'target_id');
    }
}