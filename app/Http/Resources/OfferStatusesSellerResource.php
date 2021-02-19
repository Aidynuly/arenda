<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\OfferStatus;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OfferStatusesSellerResource
 * @package App\Http\Resources
 * @mixin OfferStatus
 */
class OfferStatusesSellerResource extends JsonResource
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
            'id' => $this->id,
            'status' => $this->status,
            'price' => $this->price,
            'house' => new HouseResource($this->house)
        ];
    }
}
