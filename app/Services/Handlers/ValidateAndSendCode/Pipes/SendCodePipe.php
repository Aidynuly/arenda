<?php

declare(strict_types=1);

namespace App\Services\Handlers\ValidateAndSendCode\Pipes;

use App\Exceptions\SendCodeException;
use App\Models\SmsCode;
use App\Services\DTO\ValidateAndSendCodeDTO;
use App\Services\Sms\SmsService;
use App\Services\Traits\ConstructionHelper;

/**
 * Class SendCodePipe
 * @package App\Services\Handlers\ValidateAndSendCode\Pipes
 */
class SendCodePipe
{
    use ConstructionHelper;

    /**
     * @param ValidateAndSendCodeDTO $dto
     * @param \Closure $next
     * @return mixed
     * @throws SendCodeException
     */
    public function handle(ValidateAndSendCodeDTO $dto, \Closure $next)
    {
        $sendCodeService = new SmsService();
        $sended = $sendCodeService->sendSms($this->getNormalPhone($dto->phone), $dto->code);

        if ($sended) {
            SmsCode::create([
                'code'  => $dto->code,
                'phone' => $this->getNormalPhone($dto->phone),
            ]);
        }
        else {
            throw SendCodeException::errorSend();
        }

        return $next($dto);
    }
}
