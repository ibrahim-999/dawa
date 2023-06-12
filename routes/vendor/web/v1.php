<?php

use App\Http\Controllers\Web\Admin\v1\VendorForgotPasswordController;
use App\Http\Controllers\Web\Vendor\v1\AuthController;
use App\Http\Controllers\Web\Vendor\v1\VendorFirebaseDeviceTokenController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => 'guest'], function () {
    Route::view('login/ss', 'vendor/v1/vendor/dashboard')->name('login');
    Route::view('login', 'vendor/v1/vendor/auth/login')->name('vendor.login.view');
    Route::post('login', [AuthController::class, 'login'])->name('vendor.login.post');

    Route::get('reset-password/{token}/{email}', [VendorForgotPasswordController::class, 'showResetPasswordForm'])->name('vendor.reset-pasword.get');
    Route::post('reset-password', [VendorForgotPasswordConلtroller::class, 'submitResetPasswordForm'])->name('vendor.reset-pasword.post');
});


Route::group(['middleware' => 'auth:web-vendor'], function () {
    Route::view('/', 'vendor/v1/dashboard')->name('vendor.dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('vendor.logout');
});

Route::post('vendor-fcm-tokens', [VendorFirebaseDeviceTokenController::class, 'storeVendorTokenWithoutDeviceId'])->name('vendor.store.token');
