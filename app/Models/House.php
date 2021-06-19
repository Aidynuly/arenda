<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\House
 *
 * @property int $id
 * @property int $user_id
 * @property string $description
 * @property int $rooms
 * @property string $area
 * @property int $region_id
 * @property string $address
 * @property bool $is_active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|House newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|House newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|House query()
 * @method static \Illuminate\Database\Eloquent\Builder|House whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereUserId($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Query\Builder|House onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|House withTrashed()
 * @method static \Illuminate\Database\Query\Builder|House withoutTrashed()
 * @property-read \App\Models\Region $region
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HouseImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\User $user
 * @property float|null $lat
 * @property float|null $long
 * @method static \Illuminate\Database\Eloquent\Builder|House whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|House whereLong($value)
 */
class House extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['description', 'user_id', 'region_id', 'area', 'rooms', 'is_active', 'address', 'lat', 'long'];

    protected $casts = [
        'id' => 'int',
        'user_id' => 'int',
        'region_id' => 'int',
        'area' => 'string',
        'rooms' => 'int',
        'is_active' => 'boolean',
        'address' => 'string',
        'description' => 'string',
        'lat' => 'double',
        'long' => 'double',
    ];

    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(HouseImage::class, 'house_id');
    }

    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'house_id');
    }
}
