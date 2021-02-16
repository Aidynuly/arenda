<?php

declare(strict_types=1);

namespace App\Services\Handlers\User;

use App\Models\User;
use App\Services\DTO\User\RegisterDTO;
use Illuminate\Support\Str;

/**
 * Class RegisterHandler
 * @package App\Services\Handlers\User
 */
class RegisterHandler
{
    /**
     * @param RegisterDTO $registerDTO
     * @return User
     */
    public function handle(RegisterDTO  $registerDTO): User
    {
      return User::create([
            'name'      => $registerDTO->name,
            'surname'   => $registerDTO->surname,
            'password'  => $registerDTO->password,
            'city_id'   => $registerDTO->cityId,
            'phone'     => $registerDTO->phone,
            'type'      => $registerDTO->type,
            'token'     => Str::uuid()->toString(),
        ]);
    }
}
