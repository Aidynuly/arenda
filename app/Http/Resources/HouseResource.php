<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\House;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HouseResource
 * @package App\Http\Resources
 * @mixin House
 */
final class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'description'   => $this->description,
            'rooms'         => $this->rooms,
            'is_active'     => $this->is_active,
            'images'        => HouseImageResource::collection($this->images),
            'user'          => [
                'user_id'       => $this->user_id,
                'phone'         => $this->user->phone,
                'name'          => $this->user->name,
            ],
            'area'          => $this->area,
            'address'       => $this->address,
            'region'        => new RegionResource($this->region),
            'reviews'       => ReviewResource::collection($this->reviews)
        ];
    }
}
