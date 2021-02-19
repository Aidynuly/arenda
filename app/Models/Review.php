<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 *
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property int $id
 * @property int $user_id
 * @property int $house_id
 * @property string $text
 * @property float $star
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereHouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereStar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUserId($value)
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'house_id', 'text', 'star'];

    protected $casts = [
        'user_id'   => 'int',
        'house_id'  => 'int',
        'text'      => 'string',
        'star'      => 'float',
    ];
}
