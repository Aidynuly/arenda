<?php

declare(strict_types=1);

namespace App\Services\DTO;

use App\Models\User;

/**
 * Class OfferDTO
 * @package App\Services\DTO
 */
class OfferDTO
{
    /** @var User */
    public $user;

    /** @var float */
    public $priceFrom;

    /** @var float */
    public $priceTo;

    /** @var int */
    public $rooms;

    /** @var int */
    public $regionId;

    /**
     * @param array $array
     * @return OfferDTO
     */
    public static function fromArray(array $array): OfferDTO
    {
        $self               = new static();
        $self->user         = $array['user'];
        $self->priceFrom    = $array['price_from'];
        $self->priceTo      = $array['price_to'];
        $self->rooms        = $array['rooms'];
        $self->regionId     = $array['region_id'];

        return $self;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id'       => $this->user->id,
            'from_price'    => $this->priceFrom,
            'to_price'      => $this->priceTo,
            'rooms'         => $this->rooms,
            'region_id'     => $this->regionId,
        ];
    }
}
