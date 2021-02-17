<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SmsCode
 *
 * @property int $id
 * @property string $code
 * @property string $phone
 * @property int $verified
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SmsCode whereVerified($value)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SmsCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'phone', 'verified'];

    protected $table = 'sms_codes';
}
