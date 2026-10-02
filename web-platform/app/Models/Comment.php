<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Asset;
use App\Models\User;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'asset_id', 'content', 'created_at'];
    protected $casts = ['created_at' => 'datetime'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}