<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table = 'feeds';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'content',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
