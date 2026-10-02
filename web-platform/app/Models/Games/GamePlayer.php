<?php

namespace App\Models\Games;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class GamePlayer extends Model
{
    protected $table = 'game_presences';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = ['user_id', 'job_id', 'place_id', 'last_seen_at'];

    protected $casts = ['user_id' => 'integer', 'place_id' => 'integer', 'last_seen_at' => 'datetime'];

    public function server()
    {
        return $this->belongsTo(GameServer::class, 'job_id', 'job_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
