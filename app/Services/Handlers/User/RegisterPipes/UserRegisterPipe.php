<?php

declare(strict_types=1);

namespace App\Services\Handlers\User\RegisterPipes;

use App\Models\User;
use App\Services\DTO\User\RegisterUserDTO;
use App\Services\Traits\ConstructionHelper;
use Illuminate\Support\Str;

/**
 * Class UserRegisterPipe
 * @package App\Services\Handlers\User\RegisterPipes
 */
class UserRegisterPipe
{
    use ConstructionHelper;

    /**
     * @param RegisterUserDTO $registerDTO
     * @param \Closure $next
     * @return mixed
     */
    public function handle(RegisterUserDTO $registerDTO, \Closure $next)
    {
        $user = User::create([
            'surname'   => $registerDTO->surname,
            'name'      => $registerDTO->name,
            'type'      => $registerDTO->type,
            'city_id'   => $registerDTO->cityId,
            'password'  => $registerDTO->password,
            'phone'     => $this->getNormalPhone($registerDTO->phone),
            'token'     => Str::uuid()->toString()
        ])->refresh();

        $registerDTO->user = $user;

        return $next($registerDTO);
    }
}
