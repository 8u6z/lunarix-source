<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    protected $table = 'user_inventory';
    public $timestamps = false;
    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = ['user_id', 'asset_id', 'asset_type', 'obtained_at', 'serial_number', 'guid'];
    protected $casts = ['obtained_at' => 'datetime', 'serial_number' => 'integer'];
    const TYPE_IMAGE = Asset::TYPE_IMAGE;
    const TYPE_TSHIRT = Asset::TYPE_TSHIRT;
    const TYPE_AUDIO = Asset::TYPE_AUDIO;
    const TYPE_MESH = Asset::TYPE_MESH;
    const TYPE_LUA = Asset::TYPE_LUA;
    const TYPE_HAT = Asset::TYPE_HAT;
    const TYPE_PLACE = Asset::TYPE_PLACE;
    const TYPE_MODEL = Asset::TYPE_MODEL;
    const TYPE_SHIRT = Asset::TYPE_SHIRT;
    const TYPE_PANTS = Asset::TYPE_PANTS;
    const TYPE_DECAL = Asset::TYPE_DECAL;
    const TYPE_HEAD = Asset::TYPE_HEAD;
    const TYPE_FACE = Asset::TYPE_FACE;
    const TYPE_GEAR = Asset::TYPE_GEAR;
    const TYPE_BADGE = Asset::TYPE_BADGE;
    const TYPE_ANIMATION = Asset::TYPE_ANIMATION;
    const TYPE_TORSO = Asset::TYPE_TORSO;
    const TYPE_RIGHT_ARM = Asset::TYPE_RIGHT_ARM;
    const TYPE_LEFT_ARM = Asset::TYPE_LEFT_ARM;
    const TYPE_LEFT_LEG = Asset::TYPE_LEFT_LEG;
    const TYPE_RIGHT_LEG = Asset::TYPE_RIGHT_LEG;
    const TYPE_PACKAGE = Asset::TYPE_PACKAGE;
    const TYPE_GAME_PASS = Asset::TYPE_GAME_PASS;
    const TYPE_PLUGIN = Asset::TYPE_PLUGIN;
    const TYPES_ACCESSORIES = Asset::TYPES_ACCESSORIES;
    const TYPES_CLOTHING = Asset::TYPES_CLOTHING;
    const TYPES_BODY_PARTS = Asset::TYPES_BODY_PARTS;
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function scopeOfType($query, int $type)
    {
        return $query->where('asset_type', $type);
    }

    public function scopeAccessories($query)
    {
        return $query->whereIn('asset_type', self::TYPES_ACCESSORIES);
    }

    public function scopeClothing($query)
    {
        return $query->whereIn('asset_type', self::TYPES_CLOTHING);
    }

    public function scopeBodyParts($query)
    {
        return $query->whereIn('asset_type', self::TYPES_BODY_PARTS);
    }
}
