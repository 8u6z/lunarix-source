<?php
namespace App\Models\Friends;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';
    protected $fillable = ['user_id_one', 'user_id_two'];
}