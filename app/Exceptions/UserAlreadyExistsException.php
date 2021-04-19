<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Messages\Constant;
use Exception;

/**
 * Class UserAlreadyExistsException
 * @package App\Exceptions
 */
class UserAlreadyExistsException extends Exception implements DevMessageErrorInterface
{
    protected $devMessage = Constant::USER_ALREADY_EXISTS;

    /**
     * @return string
     */
    public function getDevMessage(): String
    {
        return $this->devMessage;
    }
}
