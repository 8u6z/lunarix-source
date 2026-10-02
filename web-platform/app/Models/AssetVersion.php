<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AssetVersion extends Model
{
    protected $table = 'asset_versions';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;
    protected $fillable = ['asset_id', 'path'];
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}