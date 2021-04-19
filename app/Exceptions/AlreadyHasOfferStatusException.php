<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Exceptions\Messages\Constant;
use Exception;

/**
 * Class AlreadyHasOfferStatusException
 * @package App\Exceptions
 */
class AlreadyHasOfferStatusException extends Exception implements DevMessageErrorInterface
{
    private $devMessage = Constant::STATUS_OFFER_ALREADY_EXIST;

    /**
     * @return String
     */
    public function getDevMessage(): String
    {
        return $this->devMessage;
    }
}
