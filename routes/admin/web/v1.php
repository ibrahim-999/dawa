<?php

use App\Http\Controllers\Api\Shared\V1\FirebaseDeviceTokenController;
use App\Http\Controllers\Web\Admin\v1\NotificationController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Web\Admin\v1\AuthController;
use \App\Http\Controllers\Web\Admin\v1\AdminController;
use App\Http\Controllers\Web\Admin\v1\AdminFirebaseDeviceTokenController;
use App\Http\Controllers\Web\Admin\v1\AdminForgotPasswordController;
use \App\Http\Controllers\Web\Admin\v1\VendorController;
use \App\Http\Controllers\Web\Admin\v1\ChainController;
use \App\Http\Controllers\Web\Admin\v1\PharmacyController;
use \App\Http\Controllers\Web\Admin\v1\RoleController;
use \App\Http\Controllers\Web\Admin\v1\VendorAclController;
use \App\Http\Controllers\Web\Admin\v1\CategoryController;
use \App\Http\Controllers\Web\Admin\v1\BrandController;
use \App\Http\Controllers\Web\Admin\v1\ProductController;
use \App\Http\Controllers\Web\Admin\v1\ProductAttributeController;
use \App\Http\Controllers\Web\Admin\v1\AttributeValueController;
use App\Http\Controllers\Web\Admin\v1\DriverController;
use App\Http\Controllers\Web\Admin\v1\ForgotPasswordController;
use App\Http\Controllers\Web\Admin\v1\UserController;
use App\Http\Controllers\Web\Admin\v1\VariantController;

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

Route::view('test', 'admin/v1/permission/index')->name('test');
Route::view('login/ss', 'admin/v1/admin/dashboard')->name('login');
Route::view('login', 'admin/v1/admin/auth/login')->name('admin.login.view');
Route::post('login', [AuthController::class, 'login'])->name('admin.login.post');

Route::group(['middleware' => 'auth:web-admin'], function () {
    Route::view('/', 'admin/v1/dashboard')->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('chains', ChainController::class);
    Route::resource('pharmacies', PharmacyController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::post('attributes/{product}', [ProductAttributeController::class,'store'])->name('attributes.store');
    Route::patch('attribute/{attribute}', [ProductAttributeController::class,'update'])->name('attributes.update');
    Route::delete('attributes/{attribute}', [ProductAttributeController::class,'destroy'])->name('attributes.destroy');
    Route::post('variants/{product}', [VariantController::class,'store'])->name('variants.store');
    Route::delete('variants/{variant}', [VariantController::class,'destroy'])->name('variants.destroy');
    Route::post('attribute_values/{attribute}', [AttributeValueController::class,'store'])->name('attribute_values.store');
    Route::patch('attribute_value/{attributeValue}', [AttributeValueController::class,'update'])->name('attribute_values.update');
    Route::delete('attribute_values/{attribute_value}', [AttributeValueController::class,'destroy'])->name('attribute_values.destroy');
    Route::resource('admins', AdminController::class);
    Route::resource('vendors', VendorController::class, [
        /**
         * rename routes name for ex:admin.vendor.index to distinguish admin routes from vendor routs
         **/
        'as' => 'admin'
    ]);
    Route::post('acl/pharmacy/{pharmacy}',[VendorAclController::class,'grantPharmacyAccess'])->name('pharmacies.acl.grant');
    Route::post('acl/chain/{chain}',[VendorAclController::class,'grantChainAccess'])->name('chains.acl.grant');
    Route::delete('acl/{access}',[VendorAclController::class,'revokeAccess'])->name('acl.revoke');

    Route::group(['prefix' => 'admins'], function () {


    });

    Route::resource('users', UserController::class);
    Route::resource('drivers', DriverController::class);

    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::get('reset-password/{token}/{email}', [AdminForgotPasswordController::class, 'showResetPasswordForm'])->name('admin.reset-pasword.get');
Route::post('reset-password', [AdminForgotPasswordController::class, 'submitResetPasswordForm'])->name('admin.reset-pasword.post');


Route::post('admin-fcm-tokens', [AdminFirebaseDeviceTokenController::class, 'storeAdminTokenWithoutDeviceId'])->name('admin.store.token');
Route::get('notifications-fetch', [NotificationController::class, 'fetchNotifications'])->name('admin.notifications.fetch');
