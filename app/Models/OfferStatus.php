<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class OfferStatus extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'offer_id', 'price', 'house_id',];

    protected $casts = [
        'id'        => 'int',
        'user_id'   => 'int',
        'status'    => 'string',
        'offer_id'  => 'int',
        'price'     => 'string',
        'house_id'  => 'int',
    ];
}
