<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Exceptions\AlreadyHasOfferStatusException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\CreateOfferStatusRequest;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OfferStatusesSellerResource;
use App\Models\Offer;
use App\Models\OfferStatus;
use App\Services\DTO\OfferDTO;
use App\Services\Handlers\Offers\CreateOfferHandler;
use App\Services\Handlers\Offers\CreateOfferStatusHandler;
use App\Services\Handlers\Offers\GetActiveOfferStatusesHandler;
use App\Services\Handlers\Offers\GetOffersByUserHandler;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class OfferController
 * @package App\Http\Controllers\V1
 */
final class OfferController extends Controller
{
    use ResponseTrait;

    /**
     * User's request
     *
     * @param CreateOfferRequest $request
     * @param CreateOfferHandler $handler
     * @return JsonResponse
     */
    public function createOffer(CreateOfferRequest $request, CreateOfferHandler $handler): JsonResponse
    {
        $handler->handle(OfferDTO::fromArray([
            'user'          => $request->get('user'),
            'price_from'    => $request->get('price_from'),
            'price_to'      => $request->get('price_to'),
            'rooms'         => $request->get('rooms'),
            'region_id'     => $request->get('region_id'),
        ]));

        return $this->response('Объявление создано', true);
    }

    /**
     * User's request
     *
     * @param Request $request
     * @param GetOffersByUserHandler $handler
     * @return JsonResponse
     */
    public function myOffers(Request $request, GetOffersByUserHandler $handler): JsonResponse
    {
        $offers = $handler->handle($request->get('user'));
        return $this->response('Мои объявления', OfferResource::collection($offers));
    }

    /**
     * Список квартир юзера, только активные.
     *
     * @param Offer $offer
     * @param GetActiveOfferStatusesHandler $handler
     * @return JsonResponse
     */
    public function getOfferStatusesById(Offer $offer, GetActiveOfferStatusesHandler $handler): JsonResponse
    {
        $offerStatuses = $handler->handle($offer);
        return $this->response('Мои отклики', OfferStatusesSellerResource::collection($offerStatuses));
    }

    /**
     * Отклонить квартиру user.
     *
     * @param OfferStatus $offerStatus
     * @return JsonResponse
     */
    public function declineOffer(OfferStatus $offerStatus): JsonResponse
    {
        $offerStatus->update([
            'status' => OfferStatus::STATUS_DECLINED,
        ]);

        return $this->response('Успешно отклонен');
    }

    /**
     * Принять квартиру user.
     *
     * @param OfferStatus $offerStatus
     * @return JsonResponse
     */
    public function acceptOffer(OfferStatus $offerStatus): JsonResponse
    {
        $offerStatus->update([
            'status' => OfferStatus::STATUS_ACCEPTED,
        ]);

        return $this->response('Успешно принят');
    }

    /**
     * Завершить оффер user.
     *
     * @param OfferStatus $offerStatus
     * @return JsonResponse
     */
    public function doneOffer(OfferStatus $offerStatus): JsonResponse
    {
        $offerStatus->update([
            'status' => OfferStatus::STATUS_DONE,
        ]);

        return $this->response('Успешно завершен');
    }

    /**
     * @param CreateOfferStatusRequest $request
     * @param CreateOfferStatusHandler $handler
     * @return JsonResponse
     * @throws AlreadyHasOfferStatusException
     */
    public function createOfferStatus(CreateOfferStatusRequest  $request, CreateOfferStatusHandler $handler): JsonResponse
    {
        $offerStatus = $handler->handle($request->getDTO());
        return $this->response('Мои отклики', new OfferStatusesSellerResource($offerStatus));
    }
}
