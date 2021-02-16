<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

/**
 * Class CityController
 * @package App\Http\Controllers\V1
 */
class CityController extends Controller
{
    /**
     * @return mixed
     */
    public function cities()
    {
        return City::orderBy('title')->get();
    }
}
