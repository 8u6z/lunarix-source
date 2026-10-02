<?php
namespace App\Models\Games;
use Illuminate\Database\Eloquent\Model;

class DatastoreReq extends Model
{
    protected $table = 'datastorereq';
    protected $fillable = ['exclusive_start_key', 'page_number'];
}