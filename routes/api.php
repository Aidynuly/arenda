<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\CityController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    //auth
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/auth', [AuthController::class, 'auth']);

    Route::get('/cities', [CityController::class, 'cities']);
});
