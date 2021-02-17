<?php

declare(strict_types=1);

namespace App\Services\DTO;

use App\Services\Traits\ConstructionHelper;

/**
 * Class ValidateAndSendCodeDTO
 * @package App\Services\DTO
 */
class ValidateAndSendCodeDTO
{
    use ConstructionHelper;

    /** @var string */
    public $phone;

    /** @var string */
    public $code;

    /**
     * @param array $array
     * @return ValidateAndSendCodeDTO
     */
    public static function fromArray(array $array): ValidateAndSendCodeDTO
    {
        $self = new static();
        $self->phone = $array['phone'];
        $self->code = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);

        return $self;
    }
}
