<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\City;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CityResource
 * @package App\Http\Resources
 * @mixin City
 */
final class CityResource extends JsonResource
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
            'id'    => $this->id,
            'title' => $this->title,
            'regions' => RegionResource::collection($this->regions),
        ];
    }
}
