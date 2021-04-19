<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Messages\Constant;
use Exception;

/**
 * Class AlreadyHasReviewException
 * @package App\Exceptions
 */
class AlreadyHasReviewException extends Exception implements DevMessageErrorInterface
{
    protected $devMessage = Constant::REVIEW_ALREADY_EXISTS;

    /**
     * @return string
     */
    public function getDevMessage(): String
    {
        return $this->devMessage;
    }
}
