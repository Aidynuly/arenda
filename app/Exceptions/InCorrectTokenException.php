<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Messages\Constant;
use Exception;

/**
 * Class InCorrectTokenException
 * @package App\Exceptions
 */
class InCorrectTokenException extends Exception implements DevMessageErrorInterface
{
    protected $devMessage = Constant::INCORRECT_TOKEN;

    /**
     * @return string
     */
    public function getDevMessage(): String
    {
        return $this->devMessage;
    }
}
