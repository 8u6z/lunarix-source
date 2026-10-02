<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserBody extends Model
{
    protected $table = 'user_body';
    protected $primaryKey = 'userid';
    public $timestamps = false;
    protected $fillable = ['userid', 'headcolor', 'leftarmcolor', 'leftlegcolor', 'rightarmcolor', 'rightlegcolor', 'torsocolor', 'avatartype'];
}