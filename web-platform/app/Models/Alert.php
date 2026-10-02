<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
	public $timestamps = false;
    protected $table = 'alerts';
    protected $fillable = ['alerttext', 'isvisible', 'author_id'];
    protected $casts = ['isvisible' => 'boolean'];
}