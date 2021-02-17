<?php

declare(strict_types=1);

namespace App\Services\Handlers\User\RegisterPipes;

use App\Models\User;
use App\Services\DTO\User\RegisterDTO;
use Illuminate\Support\Str;

/**
 * Class UserRegisterPipe
 * @package App\Services\Handlers\User\RegisterPipes
 */
class UserRegisterPipe
{
    /**
     * @param RegisterDTO $registerDTO
     * @param \Closure $next
     * @return mixed
     */
    public function handle(RegisterDTO $registerDTO, \Closure $next)
    {
        $user = User::create($registerDTO->toArray() + ['token' => Str::uuid()->toString()]);
        $registerDTO->user = $user;

        return $next($registerDTO);
    }
}
