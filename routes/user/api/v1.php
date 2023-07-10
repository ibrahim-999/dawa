<?php

use App\Http\Controllers\Api\User\V1\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\V1\AuthController;
use App\Http\Controllers\Api\User\V1\ProfileController;
use App\Http\Controllers\Api\User\V1\RegisterController;
use App\Http\Controllers\Api\User\V1\CartController;
use App\Http\Controllers\Api\User\V1\CouponController;
use App\Http\Controllers\Api\User\V1\OfferController;
use App\Http\Controllers\Api\User\V1\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'login'], function () {
    Route::post('send-otp', [AuthController::class, 'otpLogin']);
    Route::post('verify-otp', [AuthController::class, 'verifyLoginOtp']);
});
Route::group(['prefix' => 'register'], function () {
    Route::post('send-otp', [RegisterController::class, 'otpRegister']);
    Route::post('verify-otp', [RegisterController::class, 'verifyRegisterOtp']);
});

Route::group(['middleware' => ['auth:sanctum', 'checkUserStatus'] ], function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('addresses', AddressController::class);
    Route::get('getAddressByPlaceId', [AddressController::class, 'getByPlaceId']); //get by place id

    Route::put('update-profile', [ProfileController::class, 'update']);
    Route::post('update-image', [ProfileController::class, 'updateProfileImage']);
    Route::post('deactivate-account', [ProfileController::class, 'deactivateAccount']);

    Route::post('sync/cart', [CartController::class, 'syncCart']);
    Route::get('cart/current', [CartController::class, 'getCurrentCat']);
    Route::post('cart-item/create-or-update', [CartController::class, 'createOrUpdateItem']);
    Route::get('coupons/{code}', [CouponController::class, 'show']);

    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{order}', [OrderController::class, 'show']);
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus']);

    Route::get('offers', [OfferController::class, 'index']);
    Route::get('offers/{offers}', [OfferController::class, 'show']);
});
