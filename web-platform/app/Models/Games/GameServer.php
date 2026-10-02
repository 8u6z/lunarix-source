<?php

namespace App\Models\Games;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Model;

class GameServer extends Model
{
    protected $table = 'game_servers';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'job_id';

    protected $keyType = 'string';

    protected $fillable = ['asset_id', 'universe_id', 'port', 'soap_port', 'job_id', 'status', 'ip_address', 'capacity', 'ping', 'fps'];

    protected $casts = ['asset_id' => 'integer', 'universe_id' => 'integer', 'port' => 'integer', 'soap_port' => 'integer', 'status' => 'integer', 'capacity' => 'integer', 'ping' => 'integer', 'fps' => 'integer', 'created_at' => 'datetime'];

    public function players()
    {
        return $this->hasMany(GamePlayer::class, 'job_id', 'job_id');
    }

    public function place()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
