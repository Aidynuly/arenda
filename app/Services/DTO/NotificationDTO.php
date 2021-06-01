<?php

declare(strict_types=1);

namespace App\Services\DTO;

/**
 * Class NotificationDTO
 * @package App\Services\DTO
 */
class NotificationDTO
{
    /** @var string */
    public $title;

    /** @var string */
    public $body;

    /** @var string */
    public $token;

    /**
     * @param array $array
     * @return static
     */
    public static function fromArray(array $array): self
    {
        $self           = new static();
        $self->token    = $array['token'];
        $self->body     = $array['body'];
        $self->title    = $array['title'];

        return $self;
    }
}
