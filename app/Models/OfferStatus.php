<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\OfferStatus
 *
 * @property int $id
 * @property int $offer_id
 * @property int $user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus whereUserId($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property int $house_id
 * @property string $price
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus whereHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OfferStatus wherePrice($value)
 * @property-read \App\Models\House $house
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 */
class OfferStatus extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_DECLINED = 'declined';
    public const STATUS_DONE = 'done';
    public const STATUS_DELETED = 'deleted';

    public const STATUSES = [
        self::STATUS_ACCEPTED,
        self::STATUS_DECLINED,
        self::STATUS_DONE,
        self::STATUS_DELETED,
        self::STATUS_ACTIVE,
    ];

    protected $fillable = ['user_id', 'status', 'offer_id', 'price', 'house_id',];

    protected $casts = [
        'id'        => 'int',
        'user_id'   => 'int',
        'status'    => 'string',
        'offer_id'  => 'int',
        'price'     => 'string',
        'house_id'  => 'int',
    ];

    /**
     * @return BelongsTo
     */
    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class, 'house_id');
    }

    /**
     * @return BelongsTo
     */
    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }
}
