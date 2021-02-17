<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\House
 *
 * @property int $id
 * @property int $user_id
 * @property string $description
 * @property int $rooms
 * @property float $area
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
 */
class House extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'user_id', 'region_id', 'area', 'rooms', 'is_active', 'address'];

    protected $casts = [
        'id' => 'int',
        'user_int' => 'int',
        'region_id' => 'int',
        'area' => 'float',
        'rooms' => 'int',
        'is_active' => 'boolean',
        'address' => 'string',
        'description' => 'string',
    ];
}
