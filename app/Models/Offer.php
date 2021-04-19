<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Offer
 *
 * @property int $id
 * @property int $user_id
 * @property int $region_id
 * @property int $rooms
 * @property float $from_price
 * @property float $to_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereFromPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereToPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Offer whereUserId($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OfferStatus[] $offerStatuses
 * @property-read int|null $offer_statuses_count
 * @property-read \App\Models\Region $region
 */
class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'region_id', 'from_price', 'to_price', 'rooms'];

    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * @return HasMany
     */
    public function offerStatuses(): HasMany
    {
        return $this->hasMany(OfferStatus::class, 'offer_id');
    }
}
