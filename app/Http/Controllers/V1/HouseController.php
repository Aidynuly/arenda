<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\HouseResource;
use App\Models\User;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class HouseController
 * @package App\Http\Controllers\V1
 */
class HouseController extends Controller
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
}
