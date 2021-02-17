<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HouseImage
 *
 * @property int $id
 * @property int $house_id
 * @property string $image_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HouseImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HouseImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HouseImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|HouseImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HouseImage whereHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HouseImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HouseImage whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HouseImage whereUpdatedAt($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class HouseImage extends Model
{
    use HasFactory;

    protected $fillable = ['house_id', 'image_url'];

    protected $casts = [
        'house_id' => 'int',
        'image_url' => 'string',
    ];
}
