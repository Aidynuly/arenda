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
