<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Driver\V1\AuthController;
use App\Http\Controllers\Api\Driver\V1\OrderController;
use App\Http\Controllers\Api\Driver\V1\RegisterController;
use App\Http\Controllers\Api\Driver\V1\PasswordController;
use App\Http\Controllers\Api\Driver\V1\ProfileController;

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
Route::group(['prefix' => 'password'], function () {
    Route::post('login', [AuthController::class, 'passwordLogin']);
    Route::post('forget', [PasswordController::class, 'resetPasswordOtp']);
    Route::post('forget/otp-verify', [PasswordController::class, 'verifyResetPasswordOtp']);
    Route::group(['prefix' => 'register'], function () {
        Route::post('send-otp', [RegisterController::class, 'sendRegisterOtp']);
        Route::post('verify-otp', [RegisterController::class, 'verifyRegisterOtp']);
    });

});

Route::group(['middleware' => ['auth:sanctum-driver', 'checkDriverStatus', 'checkDriverProfileStatus', 'driverHeaders']], function () {
    Route::get('me', [AuthController::class, 'me']);

    Route::post('profile/step/1/complete', [ProfileController::class, 'CompleteProfileStepOne']);
    Route::post('profile/step/2/complete', [ProfileController::class, 'CompleteProfileStepTwo']);
    Route::post('profile/step/3/complete', [ProfileController::class, 'CompleteProfileStepThree']);
    Route::post('profile/update-availability', [ProfileController::class, 'updateDriverAvailability']);
    Route::post('password/reset', [PasswordController::class, 'passwordReset']);
    Route::post('logout', [AuthController::class, 'logout']);


    // Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{order}', [OrderController::class, 'show']);
    Route::patch('orders/{order}/update-status', [OrderController::class, 'updateStatus']);
});

