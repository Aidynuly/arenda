<?php

declare(strict_types=1);

namespace App\Services\Sms;

/**
 * Class SmsService
 * @package App\Services\Sms
 */
class SmsService implements SmsInterface
{
    /**
     * @param string $phone
     * @param string $code
     * @return bool
     */
    public function sendSms(string $phone, string $code): bool
    {
        return true;
    }
}
