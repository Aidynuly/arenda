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
        Route::post('offers/statuses/{offer_status}/accept', [OfferController::class, 'acceptOffer']);
        Route::post('offers/statuses/{offer_status}/decline', [OfferController::class, 'declineOffer']);
        Route::post('offers/statuses/{offer}/delete', [OfferController::class, 'declineOffer']);
        Route::post('offers/statuses/{offer_status}/done', [OfferController::class, 'doneOffer']);
        Route::post('offers/create', [OfferController::class, 'createOffer']);
        Route::post('offers/createOfferStatus', [OfferController::class, 'createOfferStatus']);
        Route::get('offers/getSellerOfferStatuses', [OfferController::class, 'getSellerOfferStatuses']);
        Route::get('offers/getOffersToSellerByUser', [OfferController::class, 'getOffersToSellerByUser']);

        Route::get('houses/get', [HouseController::class, 'getMyHouses']);
        Route::post('houses/add', [HouseController::class, 'addHouse']);
        Route::post('houses/edit/{house}', [HouseController::class, 'editHouse']);

        Route::post('reviews/create', [ReviewController::class, 'createReview']);
        Route::get('profile', [AuthController::class, 'getProfile']);
        Route::post('profile/edit', [AuthController::class, 'editProfile']);
    });
});
