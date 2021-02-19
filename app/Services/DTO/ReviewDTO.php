<?php

declare(strict_types=1);

namespace App\Services\DTO;

use App\Models\User;

class ReviewDTO
{
    /** @var User */
    public $user;

    /** @var string */
    public $text;

    /** @var float */
    public $star;

    /** @var int */
    public $houseId;

    public static function fromArray(array $array): ReviewDTO
    {
        $self = new static();
        $self->user     = $array['user'];
        $self->text     = $array['text'];
        $self->star     = $array['start'];
        $self->houseId  = $array['house_id'];

        return $self;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id'   => $this->user->id,
            'text'      => $this->text,
            'star'      => $this->star,
            'house_id'  => $this->houseId,
        ];
    }
}
