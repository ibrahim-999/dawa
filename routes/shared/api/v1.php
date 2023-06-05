<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Product\CategoryController;
use App\Http\Controllers\Api\Product\VariantController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Product\BrandController;
use App\Http\Controllers\Api\Product\WishlistController;
use App\Http\Controllers\Api\Shared\V1\CityController;
use App\Http\Controllers\Api\Shared\V1\CommentController;
use App\Http\Controllers\Api\Shared\V1\ContactController;
use App\Http\Controllers\Api\Shared\V1\FirebaseDeviceTokenController;
use App\Http\Controllers\Api\Shared\V1\LocationController;
use App\Http\Controllers\Api\Shared\V1\NotificationController;
use App\Http\Controllers\Api\Shared\V1\QuestionController;
use App\Http\Controllers\Api\Shared\V1\SettingController;

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


Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);
Route::get('variants/info/statistics', [VariantController::class, 'VariantsInfo']);
Route::get('variants', [VariantController::class, 'index']);
Route::get('variants/with-attributes', [VariantController::class, 'variantWithAttributes']);
Route::get('variants/{variant}', [VariantController::class, 'show']);
Route::get('brands', [BrandController::class, 'index']);
Route::get('brands/{brand}', [BrandController::class, 'show']);
Route::get('cities', [CityController::class, 'index']);
Route::get('common-variants', [VariantController::class, 'index']);
Route::get('recommended-variants', [VariantController::class, 'index']);
Route::get('most-liked-variants', [VariantController::class, 'index']);
Route::get('most-viewed-variants', [VariantController::class, 'index']);


Route::get('about-us', [SettingController::class, 'aboutUs']);
Route::get('privacy', [SettingController::class, 'privacy']);
Route::get('terms', [SettingController::class, 'terms']);
Route::get('questions', [QuestionController::class, 'index']);

Route::post('contact-us', [ContactController::class, 'store']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('wishlists', [WishlistController::class, 'index']);
    Route::post('wishlists', [WishlistController::class, 'store']);
    Route::delete('wishlists', [WishlistController::class, 'destroy']);

    Route::post('variants/{variant}/review', [VariantController::class, 'review']);

});

Route::group([], function () {
    Route::post('fcm-tokens', [FirebaseDeviceTokenController::class, 'store']);
});


Route::group(['middleware' => 'checkAuth'], function () {
    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('notifications/{id}', [NotificationController::class, 'show']);
    Route::post('mark-notifications-seen', [NotificationController::class, 'markAllSeen']);
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);
    Route::get('profile-comments', [CommentController::class, 'index']);
    Route::get('profile-comments/{reason}/reason', [CommentController::class, 'show']);

    Route::post('update-location', [LocationController::class, 'update']);
});
