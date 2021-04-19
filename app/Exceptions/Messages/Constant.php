<?php

declare(strict_types=1);

namespace App\Exceptions\Messages;

/**
 * Class Constant
 * @package App\Exceptions\Messages
 */
class Constant
{
    public const USER_ALREADY_EXISTS        = 'user_already_exists';
    public const REVIEW_ALREADY_EXISTS      = 'review_already_exists';
    public const STATUS_OFFER_ALREADY_EXIST = 'status_offer_already_exists';
    public const INCORRECT_TOKEN            = 'incorrect_token';
    public const NOT_AUTHORIZED             = 'not_authorized';
    public const NOT_VERIFIED_PHONE         = 'not_verified_phone';
    public const SEND_CODE_EXCEPTION        = 'send_code_exception';
    public const NOT_FOUND                  = 'not_found';
    public const VALIDATION_ERROR           = 'validation_error';
    public const SERVER_ERROR               = 'server_error';
}
