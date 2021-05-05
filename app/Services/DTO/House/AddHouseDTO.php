<?php

declare(strict_types=1);

namespace App\Services\DTO\House;

use App\Models\User;

/**
 * Class AddHouseDTO
 * @package App\Services\DTO\House
 */
class AddHouseDTO
{
    /** @var string */
    public $description;

    /** @var int */
    public $regionId;

    /** @var string */
    public $address;

    /** @var int */
    public $rooms;

    /** @var string */
    public $area;

    /** @var array */
    public $images = [];

    /** @var User */
    public $user;

    /**
     * @param array $data
     * @return AddHouseDTO
     */
    public static function fromArray(array $data): AddHouseDTO
    {
        $self               = new static();
        $self->address      = $data['address'];
        $self->description  = $data['description'];
        $self->area         = $data['area'];
        $self->images       = $data['images'] ?? [];
        $self->rooms        = $data['rooms'];
        $self->regionId     = $data['region_id'];
        $self->user         = $data['user'];

        return $self;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id'       => $this->user->id,
            'address'       => $this->address,
            'description'   => $this->description,
            'area'          => $this->area,
            'rooms'         => $this->rooms,
            'region_id'     => $this->regionId,
        ];
    }
}
