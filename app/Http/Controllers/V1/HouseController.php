<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddHouseRequest;
use App\Http\Resources\HouseResource;
use App\Models\House;
use App\Models\User;
use App\Services\Handlers\House\AddHouseHandler;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class HouseController
 * @package App\Http\Controllers\V1
 */
final class HouseController extends Controller
{
    use ResponseTrait;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getMyHouses(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->get('user');
        return $this->response('Мои квартиры', HouseResource::collection($user->houses));
    }

    /**
     * @param AddHouseRequest $request
     * @param AddHouseHandler $handler
     * @return JsonResponse
     */
    public function addHouse(AddHouseRequest $request, AddHouseHandler $handler): JsonResponse
    {
        $handler->handle($request->getDTO());
        return $this->response('Успешно добавлено', true);
    }

    /**
     * @param House $house
     * @param Request $request
     * @return JsonResponse
     */
    public function editHouse(House $house, Request $request): JsonResponse
    {
        return $this->response('ТОДО');
    }
}
