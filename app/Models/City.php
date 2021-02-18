<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\City
 *
 * @property int $id
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereTitle($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Region[] $regions
 * @property-read int|null $regions_count
 */
class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['title'];

    protected $casts = [
        'title' => 'string',
    ];

    /**
     * @return HasMany
     */
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class, 'city_id');
    }
}
