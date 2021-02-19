<?php

declare(strict_types=1);

namespace App\Services\DTO;

use App\Models\User;

/**
 * Class OfferStatusDTO
 * @package App\Services\DTO
 */
class OfferStatusDTO
{
    /** @var User */
    public $user;

    /** @var int */
    public $offerId;

    /** @var string */
    public $price;

    /** @var int */
    public $houseId;

    /**
     * @param array $array
     * @return OfferStatusDTO
     */
    public static function fromArray(array $array): OfferStatusDTO
    {
        $self           = new static();
        $self->houseId  = $array['house_id'];
        $self->user     = $array['user'];
        $self->offerId  = $array['offer_id'];
        $self->price    = $array['price'];

        return $self;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id'   => $this->user->id,
            'house_id'  => $this->houseId,
            'offer_id'  => $this->offerId,
            'price'     => $this->price,
        ];
    }
}
