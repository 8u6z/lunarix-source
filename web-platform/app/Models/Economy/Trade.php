<?php
namespace App\Models\Economy;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'status', 'sender_robux', 'receiver_robux', 'expires_at'];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function items()
    {
        return $this->hasMany(TradeItem::class);
    }

    public function senderItems()
    {
        return $this->hasMany(TradeItem::class)->where('user_id', $this->sender_id);
    }

    public function receiverItems()
    {
        return $this->hasMany(TradeItem::class)->where('user_id', $this->receiver_id);
    }
}