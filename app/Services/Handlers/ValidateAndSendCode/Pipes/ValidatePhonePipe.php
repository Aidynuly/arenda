<?php

declare(strict_types=1);

namespace App\Services\Handlers\ValidateAndSendCode\Pipes;

use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\Services\DTO\ValidateAndSendCodeDTO;
use App\Services\Traits\ConstructionHelper;

class ValidatePhonePipe
{
    use ConstructionHelper;

    /**
     * @param ValidateAndSendCodeDTO $dto
     * @param \Closure $next
     * @throws UserAlreadyExistsException
     */
    public function handle(ValidateAndSendCodeDTO $dto, \Closure $next)
    {
        $user = User::wherePhone($this->getNormalPhone($dto->phone))->exists();

        if ($user) {
            throw new UserAlreadyExistsException('Пользователь уже существует');
        }

        return $next($dto);
    }
}
