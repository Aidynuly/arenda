<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Exceptions\AlreadyHasOfferStatusException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\CreateOfferStatusRequest;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OfferStatusesResource;
use App\Http\Resources\OfferStatusesSellerResource;
use App\Models\Offer;
use App\Services\DTO\OfferDTO;
use App\Services\Handlers\Offers\CreateOfferHandler;
use App\Services\Handlers\Offers\CreateOfferStatusHandler;
use App\Services\Handlers\Offers\GetOffersByUserHandler;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class OfferController
 * @package App\Http\Controllers\V1
 */
class OfferController extends Controller
{
    use ResponseTrait;

    /**
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
     * @param Offer $offer
     * @return JsonResponse
     */
    public function getOfferStatusesById(Offer $offer): JsonResponse
    {
        return $this->response('Мои отклики', new OfferStatusesResource($offer));
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
