<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\CityController;
use App\Http\Controllers\V1\OfferController;
use App\Http\Controllers\V1\HouseController;
use App\Http\Controllers\V1\ReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    //auth
    Route::post('/validate_phone', [AuthController::class, 'validatePhone']);
    Route::post('/verify_code', [AuthController::class, 'verifyCode']);
    Route::post('/register_user', [AuthController::class, 'registerUser']);
    Route::post('/register_seller', [AuthController::class, 'registerSeller']);
    Route::post('/auth', [AuthController::class, 'auth']);

    Route::get('/cities', [CityController::class, 'cities']);

    Route::middleware(['check.auth'])->group(function() {
        Route::get('offers/get', [OfferController::class, 'myOffers']);
        Route::get('offers/statuses/{offer}', [OfferController::class, 'getOfferStatusesById']);
        Route::post('offers/create', [OfferController::class, 'createOffer']);
        Route::post('offers/createOfferStatus', [OfferController::class, 'createOfferStatus']);

        Route::get('houses/get', [HouseController::class, 'getMyHouses']);

        Route::post('reviews/create', [ReviewController::class, 'createReview']);
    });
});
