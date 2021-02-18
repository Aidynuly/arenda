<?php

declare(strict_types=1);

namespace App\Services\Handlers\Offers;

use App\Models\Offer;
use App\Services\DTO\OfferDTO;

/**
 * Class CreateOfferHandler
 * @package App\Services\Handlers\Offers
 */
class CreateOfferHandler
{
    /**
     * @param OfferDTO $DTO
     */
    public function handle(OfferDTO $DTO)
    {
        Offer::create($DTO->toArray());
    }
}
