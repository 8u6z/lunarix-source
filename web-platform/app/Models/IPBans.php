<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IPBans extends Model
{
    protected $table = 'ip_bans';
    protected $fillable = ['user_id', 'ip_hash', 'reason'];
}