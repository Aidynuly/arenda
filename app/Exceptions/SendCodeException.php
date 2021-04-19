<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Messages\Constant;
use Exception;

/**
 * Class SendCodeException
 * @package App\Exceptions
 */
class SendCodeException extends Exception implements DevMessageErrorInterface
{
   protected $devMessage = Constant::SEND_CODE_EXCEPTION;

    /**
     * @return string
     */
    public function getDevMessage(): String
    {
        return $this->devMessage;
    }
}
