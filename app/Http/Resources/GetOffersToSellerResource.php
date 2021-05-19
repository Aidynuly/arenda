<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class GetOffersToSellerResource
 * @package App\Http\Resources
 */
class GetOffersToSellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'from_price'    => $this->from_price,
            'to_price'      => $this->to_price,
            'rooms'         => $this->rooms,
            'region_title'  => $this->region_title,
            'city_title'    => $this->city_title,
            'user_name'     => $this->user_name,
            'user_surname'  => $this->user_surname,
        ];
    }
}
