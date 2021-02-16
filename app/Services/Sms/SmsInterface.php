<?php

declare(strict_types=1);

namespace App\Services\Sms;

/**
 * Interface SmsInterface
 * @package App\Services\Sms
 */
interface SmsInterface
{
    /**
     * @param string $phone
     * @param string $code
     * @return bool
     */
    public function sendSms(string $phone, string $code): bool;
}
