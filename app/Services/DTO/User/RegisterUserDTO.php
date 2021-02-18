<?php

declare(strict_types=1);

namespace App\Services\DTO\User;

use App\Models\User;

/**
 * Class RegisterUserDTO
 * @package App\Services\DTO\User
 */
class RegisterUserDTO implements UserDtoInterface
{
    /** @var User */
    public $user;

    /** @var string */
    public $name;

    /** @var string */
    public $surname;

    /** @var string */
    public $password;

    /** @var int */
    public $cityId;

    /** @var string */
    public $type;

    /** @var string */
    public $phone;

    /**
     * @param array $array
     * @return RegisterUserDTO
     */
    public static function fromArray(array $array): RegisterUserDTO
    {
        $self           = new static();
        $self->surname  = $array['surname'];
        $self->name     = $array['name'];
        $self->type     = $array['type'];
        $self->cityId   = $array['city_id'];
        $self->password = $array['password'];
        $self->phone    = $array['phone'];

        return $self;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'surname'   => $this->surname,
            'name'      => $this->name,
            'type'      => $this->type,
            'city_id'   => $this->cityId,
            'password'  => $this->password,
            'phone'     => $this->phone,
        ];
    }
}
