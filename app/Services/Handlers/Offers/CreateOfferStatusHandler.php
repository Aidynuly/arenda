<?php

declare(strict_types=1);

namespace App\Services\Handlers\Offers;

use App\Exceptions\AlreadyHasOfferStatusException;
use App\Jobs\SendPushJob;
use App\Models\OfferStatus;
use App\Models\Offer;
use App\Models\User;
use App\Services\DTO\NotificationDTO;
use App\Services\DTO\OfferStatusDTO;
use App\Services\FirebaseNotification;

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(OfferStatusDTO $offerStatusDTO): OfferStatus
    {
        $this->validate($offerStatusDTO->user, (int)$offerStatusDTO->offerId);
        $offer = OfferStatus::create(
            $offerStatusDTO->toArray() + ['status' => OfferStatus::STATUS_ACTIVE]
        );

        //Рефакторинг
        $token = Offer::whereId($offerStatusDTO->offerId)
            ->first()
            ->user
            ->token;

        SendPushJob::dispatch(NotificationDTO::fromArray([
            'token' => $token,
            'Завершено',
            'Вашу заявку завершили',
        ]));

        return $offer;
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
