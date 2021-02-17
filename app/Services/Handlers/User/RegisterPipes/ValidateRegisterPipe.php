<?php

declare(strict_types=1);

namespace App\Services\Handlers\User\RegisterPipes;

use App\Exceptions\NotVerifiedPhone;
use App\Models\SmsCode;
use App\Services\DTO\User\RegisterDTO;
use App\Services\Traits\ConstructionHelper;

/**
 * Class ValidateRegisterPipe
 * @package App\Services\Handlers\User\RegisterPipes
 */
class ValidateRegisterPipe
{
    use ConstructionHelper;

    /**
     * @param RegisterDTO $registerDTO
     * @param \Closure $next
     * @return mixed
     * @throws NotVerifiedPhone
     */
    public function handle(RegisterDTO $registerDTO, \Closure $next)
    {
        $sms = SmsCode::wherePhone($this->getNormalPhone($registerDTO->phone))
            ->whereVerified(true)
            ->exists();

        if (!$sms) {
            throw new NotVerifiedPhone('Телефон все еще не проверен');
        }

        return $next($registerDTO);
    }
}
