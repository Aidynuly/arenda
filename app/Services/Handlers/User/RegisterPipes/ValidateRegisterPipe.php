<?php

declare(strict_types=1);

namespace App\Services\Handlers\User\RegisterPipes;

use App\Exceptions\NotVerifiedPhone;
use App\Exceptions\UserAlreadyExistsException;
use App\Models\SmsCode;
use App\Models\User;
use App\Services\DTO\User\RegisterUserDTO;
use App\Services\DTO\User\UserDtoInterface;
use App\Services\Traits\ConstructionHelper;

/**
 * Class ValidateRegisterPipe
 * @package App\Services\Handlers\User\RegisterPipes
 */
class ValidateRegisterPipe
{
    use ConstructionHelper;

    /**
     * @param UserDtoInterface $registerDTO
     * @param \Closure $next
     * @return mixed
     * @throws NotVerifiedPhone
     * @throws UserAlreadyExistsException
     */
    public function handle(UserDtoInterface $registerDTO, \Closure $next)
    {
        $sms = SmsCode::wherePhone($this->getNormalPhone($registerDTO->phone))
            ->whereVerified(true)
            ->exists();

        if (!$sms) {
            throw new NotVerifiedPhone('Телефон не прошел проверку');
        }

        $user = User::wherePhone($this->getNormalPhone($registerDTO->phone))->exists();

        if ($user) {
             throw new UserAlreadyExistsException('Пользователь уже существует');
        }

        return $next($registerDTO);
    }
}
