<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('/loginCostumer', [UserController::class, 'loginCostumer']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum', 'token.expiration'])->group(function () {
    Route::get('/states', [StateController::class, 'getStatesApi']);
    Route::get('/products/{stateId}', [ProductController::class, 'getProductsByState']);
    Route::get('/customers', [CustomerController::class, 'getCustomersApi']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/categories', [CategoryController::class, 'indexApi']);
    Route::get('/indexApi/{id}', [OrderController::class, 'indexApi']);
    Route::get('/showApi/{id}', [OrderController::class, 'showApi']);
    Route::post('/validate-coupon', [CouponController::class, 'validateCoupon']);
    Route::get('/indexApiCustomers/{id}', [OrderController::class, 'indexApiCustomers']);
});
