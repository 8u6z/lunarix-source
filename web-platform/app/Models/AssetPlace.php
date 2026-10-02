<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetPlace extends Model
{
    protected $table = 'asset_places';
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id', 'id');
    }
}