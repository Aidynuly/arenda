<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Region
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property int $id
 * @property string $title
 * @property int $city_id
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereTitle($value)
 * @property-read \App\Models\City $city
 */
class Region extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'city_id'];

    public $timestamps = false;

    protected $casts = [
        'title' => 'string',
        'city_id' => 'int',
    ];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
