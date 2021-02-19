<?php

declare(strict_types=1);

namespace App\Services\Handlers\Offers;

use App\Exceptions\AlreadyHasOfferStatusException;
use App\Models\OfferStatus;
use App\Models\User;
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
     * @throws AlreadyHasOfferStatusException
     */
    public function handle(OfferStatusDTO $offerStatusDTO): OfferStatus
    {
        $this->validate($offerStatusDTO->user, (int)$offerStatusDTO->offerId);

        return OfferStatus::create(
            $offerStatusDTO->toArray() + ['status' => OfferStatus::STATUS_ACCEPTED]
        );
    }

    /**
     * @param User $user
     * @param int $offerId
     * @throws AlreadyHasOfferStatusException
     */
    private function validate(User $user, int $offerId): void
    {
        $alreadyHasOfferStatus = OfferStatus::whereUserId($user->id)
            ->where('offer_id', $offerId)
            ->exists();

        if ($alreadyHasOfferStatus) {
            throw new AlreadyHasOfferStatusException('Вы уже откликнулись');
        }
    }
}
