<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Offer;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OfferStatusesResource
 * @package App\Http\Resources
 * @mixin Offer
 */
class OfferStatusesResource extends JsonResource
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
            'id' => $this->id,
            'offer_statuses' => OfferStatusesSellerResource::collection($this->offerStatuses)
        ];
    }
}
