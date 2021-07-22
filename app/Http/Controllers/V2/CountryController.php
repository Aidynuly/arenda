<?php

declare(strict_types=1);

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * Class CountryController
 * @package App\Http\Controllers\V2
 */
final class CountryController extends Controller
{
    use ResponseTrait;

    /**
     * @return JsonResponse
     */
    public function getCountries(): JsonResponse
    {
        $countries = Country::all();
        return $this->response('Все страны', CountryResource::collection($countries));
    }
}
