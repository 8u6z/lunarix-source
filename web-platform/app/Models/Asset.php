<?php

namespace App\Models;

use App\Models\Games\GamePlayer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'assets';
    protected $fillable = ['creator_id', 'type', 'name', 'description', 'access', 'favourites', 'can_comment', 'onsale', 'sales_count', 'current_version_id', 'universe_id', 'ghosted', 'robux', 'visits', 'max_players', 'genres', 'gear_types', 'related_to', 'approval', 'is_limited', 'is_limited_unique', 'limited_quantity', 'staff_picks', 'lunarix_classic', 'thumbnail_approval', 'thumbnail_square_approval'];
    protected $casts = ['type' => 'integer', 'approval' => 'integer', 'can_comment' => 'boolean', 'onsale' => 'boolean', 'ghosted' => 'boolean', 'genres' => 'array', 'gear_types' => 'array', 'is_limited' => 'boolean', 'is_limited_unique' => 'boolean', 'limited_quantity' => 'integer', 'sales_count' => 'integer', 'staff_picks' => 'boolean', 'lunarix_classic' => 'boolean'];
    public const APPROVAL_PENDING = 0;
    public const APPROVAL_APPROVED = 1;
    public const APPROVAL_REJECTED = 2;
    public const FEATURED_CREATOR_ID = 1;
    const TYPE_IMAGE = 1;
    const TYPE_TSHIRT = 2;
    const TYPE_AUDIO = 3;
    const TYPE_MESH = 4;
    const TYPE_LUA = 5;
    const TYPE_HAT = 8;
    const TYPE_PLACE = 9;
    const TYPE_MODEL = 10;
    const TYPE_SHIRT = 11;
    const TYPE_PANTS = 12;
    const TYPE_DECAL = 13;
    const TYPE_HEAD = 17;
    const TYPE_FACE = 18;
    const TYPE_GEAR = 19;
    const TYPE_BADGE = 21;
    const TYPE_ANIMATION = 24;
    const TYPE_TORSO = 27;
    const TYPE_RIGHT_ARM = 28;
    const TYPE_LEFT_ARM = 29;
    const TYPE_LEFT_LEG = 30;
    const TYPE_RIGHT_LEG = 31;
    const TYPE_PACKAGE = 32;
    const TYPE_GAME_PASS = 34;
    const TYPE_PLUGIN = 38;
    const TYPES_ACCESSORIES = [
        self::TYPE_HAT
    ];
    const TYPES_CLOTHING = [
        self::TYPE_TSHIRT,
        self::TYPE_SHIRT,
        self::TYPE_PANTS
    ];
    const TYPES_BODY_PARTS = [
        self::TYPE_HEAD,
        self::TYPE_TORSO,
        self::TYPE_RIGHT_ARM,
        self::TYPE_LEFT_ARM,
        self::TYPE_RIGHT_LEG,
        self::TYPE_LEFT_LEG,
        self::TYPE_FACE
    ];
    public const CATEGORY_TYPE_MAP = [
        2 => self::TYPES_ACCESSORIES,
        3 => self::TYPES_CLOTHING,
        4 => self::TYPES_BODY_PARTS,
        5 => [self::TYPE_GEAR]
    ];
    public const SUBCATEGORY_TYPE_MAP = [
        9 => self::TYPE_HAT,
        12 => self::TYPE_SHIRT,
        13 => self::TYPE_TSHIRT,
        14 => self::TYPE_PANTS,
        5 => self::TYPE_GEAR,
        10 => self::TYPE_FACE,
        11 => self::TYPE_PACKAGE,
        15 => self::TYPE_HEAD,
    ];
    public const FEATURED_TYPES = [
        self::TYPE_HAT,
        self::TYPE_GEAR,
        self::TYPE_PACKAGE
    ];
    public function scopeOfType(Builder $query, int $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopePlaces(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_PLACE);
    }

    public function scopeClothing(Builder $query): Builder
    {
        return $query->whereIn('type', self::TYPES_CLOTHING);
    }

    public function scopeAccessories(Builder $query): Builder
    {
        return $query->whereIn('type', self::TYPES_ACCESSORIES);
    }

    public function scopeAnimations(Builder $query): Builder
    {
        return $query->whereIn('type', self::TYPES_ANIMATIONS);
    }

    public function scopeBodyParts(Builder $query): Builder
    {
        return $query->whereIn('type', self::TYPES_BODY_PARTS);
    }

    public function scopeNotGhosted(Builder $query): Builder
    {
        return $query->where('ghosted', false);
    }

    public function scopeOnSale(Builder $query): Builder
    {
        return $query->where('onsale', true);
    }

    public function scopePubliclyAvailable(Builder $query): Builder
    {
        return $query->where(function (Builder $builder) {
            $builder->whereIn('type', [self::TYPE_PLACE, self::TYPE_MESH])->orWhere('approval', self::APPROVAL_APPROVED);
        });
    }

    public function scopeRequiresReview(Builder $query): Builder
    {
        return $query->whereNotIn('type', [self::TYPE_PLACE, self::TYPE_MESH]);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function universe()
    {
        return $this->belongsTo(Universe::class, 'universe_id');
    }

    public function inventoryEntries()
    {
        return $this->hasMany(Inventory::class, 'asset_id');
    }

    public function isPlace(): bool
    {
        return $this->type === self::TYPE_PLACE;
    }

    public function isBadge(): bool
    {
        return $this->type === self::TYPE_BADGE;
    }

    public function isGamePass(): bool
    {
        return $this->type === self::TYPE_GAME_PASS;
    }

    public function isGhosted(): bool
    {
        return $this->ghosted;
    }

    public function needsReview(): bool
    {
        return ! in_array($this->type, [self::TYPE_PLACE, self::TYPE_MESH], true);
    }

    public function isUnderReview(): bool
    {
        return $this->approval === self::APPROVAL_PENDING;
    }

    public function isNotApproved(): bool
    {
        return $this->approval === self::APPROVAL_REJECTED;
    }

    public function isPubliclyAvailable(): bool
    {
        return ! $this->needsReview() || $this->approval === self::APPROVAL_APPROVED;
    }

    public function isNewArrival(): bool
    {
        return $this->created_at !== null && $this->created_at->greaterThanOrEqualTo(now()->subDays(3));
    }

    public function isSoldOut(): bool
    {
        return $this->is_limited && $this->limited_quantity !== null && $this->sales_count >= $this->limited_quantity;
    }

    public function remainingQuantity(): ?int
    {
        return $this->is_limited && $this->limited_quantity !== null ? max(0, $this->limited_quantity - $this->sales_count) : null;
    }

    public function isAccessory(): bool
    {
        return in_array($this->type, self::TYPES_ACCESSORIES);
    }

    public function isAnimation(): bool
    {
        return in_array($this->type, self::TYPES_ANIMATIONS);
    }

    public function isClothing(): bool
    {
        return in_array($this->type, self::TYPES_CLOTHING);
    }

    public function relatedAsset()
    {
        return $this->belongsTo(Asset::class, 'related_to');
    }

    public function gamePlayers()
    {
        return $this->hasMany(GamePlayer::class, 'place_id', 'id');
    }

    public function getTypeName(): string
    {
        return match ($this->type) {
            self::TYPE_IMAGE => 'Image',
            self::TYPE_TSHIRT => 'T-Shirt',
            self::TYPE_AUDIO => 'Audio',
            self::TYPE_MESH => 'Mesh',
            self::TYPE_LUA => 'Lua',
            self::TYPE_HAT => 'Hat',
            self::TYPE_PLACE => 'Place',
            self::TYPE_MODEL => 'Model',
            self::TYPE_SHIRT => 'Shirt',
            self::TYPE_PANTS => 'Pants',
            self::TYPE_DECAL => 'Decal',
            self::TYPE_HEAD => 'Head',
            self::TYPE_FACE => 'Face',
            self::TYPE_GEAR => 'Gear',
            self::TYPE_BADGE => 'Badge',
            self::TYPE_ANIMATION => 'Animation',
            self::TYPE_TORSO => 'Torso',
            self::TYPE_RIGHT_ARM => 'Right Arm',
            self::TYPE_LEFT_ARM => 'Left Arm',
            self::TYPE_LEFT_LEG => 'Left Leg',
            self::TYPE_RIGHT_LEG => 'Right Leg',
            self::TYPE_PACKAGE => 'Package',
            self::TYPE_GAME_PASS => 'Game Pass',
            self::TYPE_PLUGIN => 'Plugin',
            default => 'Unknown'
        };
    }

    public static function slugify(string $name): string
    {
        $name = preg_replace('/\s+/', ' ', trim($name));
        $name = preg_replace('/[^A-Za-z0-9 ]/', '', $name);
        $name = trim($name);
        if ($name === '') {
            return 'unnamed';
        }
        return strtolower(preg_replace('/\s+/', '-', $name));
    }

    public function getSlug(): string
    {
        return self::slugify($this->name);
    }
}