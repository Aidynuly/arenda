<?php

declare(strict_types=1);

namespace App\Services\Handlers\Offers;

use App\Models\Offer;
use App\Models\OfferStatus;

/**
 * Class GetActiveOfferStatusesHandler
 * @package App\Services\Handlers\Offers
 */
class GetActiveOfferStatusesHandler
{
    /**
     * @param Offer $offer
     * @return OfferStatus[]|\Illuminate\Database\Eloquent\Collection
     */
    public function handle(Offer $offer)
    {
        $offersStatuses = $offer
            ->offerStatuses
            ->whereIn('status', [
                OfferStatus::STATUS_ACCEPTED,
                OfferStatus::STATUS_DONE,
                OfferStatus::STATUS_ACTIVE,
            ]);
        return $offersStatuses;
    }
}
