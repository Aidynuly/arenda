<?php

declare(strict_types=1);

namespace App\Services\Handlers\Offers;

use App\Models\OfferStatus;
use App\Services\DTO\OfferStatusDTO;

/**
 * Class CreateOfferStatusHandler
 * @package App\Services\Handlers\Offers
 */
class CreateOfferStatusHandler
{
    /**
     * @param OfferStatusDTO $offerStatusDTO
     * @return OfferStatus
     */
    public function handle(OfferStatusDTO $offerStatusDTO): OfferStatus
    {
        return OfferStatus::create(
            $offerStatusDTO->toArray() + ['status' => OfferStatus::STATUS_ACCEPTED]
        );
    }
}
