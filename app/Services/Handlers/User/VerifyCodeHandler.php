<?php

declare(strict_types=1);

namespace App\Services\Handlers\User;

use App\Models\SmsCode;
use App\Services\Traits\ConstructionHelper;

/**
 * Class VerifyCodeHandler
 * @package App\Services\Handlers\User
 */
class VerifyCodeHandler
{
    use ConstructionHelper;

    /**
     * @param string $phone
     * @param string $code
     * @return bool
     */
    public function handle(string $phone, string $code): bool
    {
        $sms = SmsCode::wherePhone($phone)->whereCode($code)->first();

        if ($sms) {
            $sms->update(['verified' => true]);
            return true;
        }

        return false;
    }
}
