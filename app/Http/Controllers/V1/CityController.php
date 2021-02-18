<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Models\Region;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\Request;

/**
 * Class CityController
 * @package App\Http\Controllers\V1
 */
class CityController extends Controller
{
    use ResponseTrait;

    /**
     * @return mixed
     */
    public function cities()
    {
        $cities = City::orderBy('title')->get();
        return $this->response('Города', CityResource::collection($cities));
    }
}
