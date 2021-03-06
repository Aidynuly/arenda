<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Offer;
use App\Models\OfferStatus;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class OfferResource
 * @package App\Http\Resources
 * @mixin Offer
 */
final class OfferResource extends JsonResource
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
            'from_price'    => $this->from_price,
            'to_price'      => $this->to_price,
            'rooms'         => $this->rooms,
            'region'        => new RegionResource($this->region),
            'offers'        => count($this->offerStatuses->whereNotIn('status', [OfferStatus::STATUS_DECLINED, OfferStatus::STATUS_DELETED],)),
        ];
    }
}
