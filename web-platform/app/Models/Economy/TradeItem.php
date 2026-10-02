<?php
namespace App\Models\Economy;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;

class TradeItem extends Model
{
    public $timestamps = false;
    protected $fillable = ['trade_id', 'user_id', 'inventory_id'];
    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function inventoryItem()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
}