<?php

declare(strict_types=1);

namespace App\Services\Handlers\User;

use App\Models\User;
use App\Services\DTO\User\RegisterDTO;
use Illuminate\Support\Str;

/**
 * Class RegisterUserHandler
 * @package App\Services\Handlers\User
 */
class AuthHandler
{
    /**
     * @param string $phone
     * @param string $password
     * @return User
     */
    public function handle(string $phone, string $password): User
    {

    }
}
