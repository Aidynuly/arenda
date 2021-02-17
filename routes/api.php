<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\CityController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    //auth
    Route::post('/validate_phone', [AuthController::class, 'validatePhone']);
    Route::post('/verify_code', [AuthController::class, 'verifyCode']);
    Route::post('/register_user', [AuthController::class, 'registerUser']);
    Route::post('/register_seller', [AuthController::class, 'registerSeller']);
    Route::post('/auth', [AuthController::class, 'auth']);

    Route::get('/cities', [CityController::class, 'cities']);
});