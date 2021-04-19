<?php

namespace App\Exceptions;

use App\Exceptions\Messages\Constant;
use Exception;

/**
 * Class NotVerifiedPhone
 * @package App\Exceptions
 */
class NotVerifiedPhone extends Exception implements DevMessageErrorInterface
{
    private $devMessage = Constant::NOT_VERIFIED_PHONE;

    /**
     * @return string
     */
    public function getDevMessage(): String
    {
        return $this->devMessage;
    }
}
