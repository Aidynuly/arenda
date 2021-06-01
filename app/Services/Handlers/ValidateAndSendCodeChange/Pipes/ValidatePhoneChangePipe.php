<?php

declare(strict_types=1);

namespace App\Services\Handlers\ValidateAndSendCodeChange\Pipes;

use App\Exceptions\UserAlreadyExistsException;
use App\Models\User;
use App\Services\DTO\ValidateAndSendCodeDTO;
use App\Services\Traits\ConstructionHelper;

class ValidatePhoneChangePipe
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

        if (!$user) {
            throw new UserAlreadyExistsException('Пользователь не существует');
        }

        return $next($dto);
    }
}
