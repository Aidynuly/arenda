<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Exceptions\AlreadyHasOfferStatusException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\CreateOfferStatusRequest;
use App\Http\Resources\GetOffersToSellerResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OfferStatusesSellerResource;
use App\Models\Offer;
use App\Models\OfferStatus;
use App\Models\User;
use App\Services\DTO\OfferDTO;
use App\Services\Handlers\Offers\CreateOfferHandler;
use App\Services\Handlers\Offers\CreateOfferStatusHandler;
use App\Services\Handlers\Offers\GetActiveOfferStatusesHandler;
use App\Services\Handlers\Offers\GetOffersByUserHandler;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSellerOfferStatuses(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->get('user');
        $data = OfferStatus::whereUserId($user->id)
            ->where('status', '!=', OfferStatus::STATUS_DELETED)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $this->response('Отклики', OfferStatusesSellerResource::collection($data));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getOffersToSellerByUser(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->get('user');
        $offers = DB::table('offers')
            ->select('offers.id', 'offers.from_price', 'offers.to_price',
                'offers.rooms', 'regions.title as region_title',
                'cities.title as city_title', 'users.name as user_name', 'users.surname as user_surname')
	        ->distinct('offers.id')
            ->join('users', 'users.id', '=', 'offers.user_id')
            ->join('regions', 'offers.region_id', '=', 'regions.id')
            ->join('cities', 'cities.id', '=', 'regions.city_id')
            ->leftJoin('offer_statuses', 'offers.id', '=', 'offer_statuses.offer_id')
            ->whereNull('offer_statuses.offer_id')
            ->orWhere('offer_statuses.user_id', '!=', $user->id)
            ->whereIn('offers.region_id', $user->city->regions->pluck('id'))
            ->orderByDesc('offers.id')
            ->get();

        foreach ($offers as $index => $offer) {
            $alreadyHasOffer = OfferStatus::whereOfferId($offer->id)
                ->whereUserId($user->id)
                ->exists();

            if($alreadyHasOffer) {
                unset($offers[$index]);
            }
        }

        return $this->response('отклики', GetOffersToSellerResource::collection($offers));
    }

    /**
     * @param Offer $offer
     * @param Request $request
     * @return JsonResponse
     */
    public function declineOfferSeller(Offer $offer, Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->get('user');
        //TODO:validate if exists
        OfferStatus::create([
            'offer_id' => $offer->id,
            'user_id' => $user->id,
            'status' => OfferStatus::STATUS_DELETED,
        ]);

        return $this->response('Успешно удалена');
    }
}
