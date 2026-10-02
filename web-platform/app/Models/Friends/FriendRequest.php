<?php
namespace App\Models\Friends;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $table = 'friend_requests';
    protected $fillable = ['user_id_one', 'user_id_two'];
}