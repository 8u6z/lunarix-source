<?php
namespace App\Models\Games;
use Illuminate\Database\Eloquent\Model;

class DStoresModel extends Model
{
    protected $table = 'datastores';
    public $timestamps = false;
    protected $fillable = ['key', 'universe_id', 'type', 'scope', 'target', 'value'];
    protected $casts = ['universe_id' => 'integer'];
}