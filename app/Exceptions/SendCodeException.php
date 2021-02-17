<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Class SendCodeException
 * @package App\Exceptions
 */
class SendCodeException extends Exception
{
    /**
     * @return static
     */
    public static function errorSend(): SendCodeException
    {
        return new static('Ошибка при отправке смс. Повторите еще');
    }
}
