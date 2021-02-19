<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * Class CityController
 * @package App\Http\Controllers\V1
 */
class CityController extends Controller
{
    use ResponseTrait;

    /**
     * @return JsonResponse
     */
    public function cities(): JsonResponse
    {
        $cities = City::orderBy('title')->get();
        return $this->response('Города', CityResource::collection($cities));
    }
}
