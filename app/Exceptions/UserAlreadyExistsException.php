<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Class UserAlreadyExistsException
 * @package App\Exceptions
 */
class UserAlreadyExistsException extends Exception
{
    /**
     * @param string $phone
     * @return static
     */
    public static function exists(string $phone): self
    {
        return new static('Такой номер телефона уже существует '.$phone);
    }
}
