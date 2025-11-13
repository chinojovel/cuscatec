<?php

use App\Http\Controllers\CustomerEco\CustomerEcoCategoriesController;
use App\Http\Controllers\CustomerEco\CustomerEcoCustomerController;
use App\Http\Controllers\CustomerEco\CustomerEcoHomeController;
use App\Http\Controllers\CustomerEco\CustomerEcoOrderController;
use App\Http\Controllers\CustomerEco\CustomerEcoOrderSellerController;
use App\Http\Controllers\CustomerEco\CustomerEcoProductController;
use App\Http\Controllers\CustomerEco\CustomerEcoSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
//Grupo para las rutas para ventas
// Ruta de login sin middleware
Route::get('/customer-ecommerce/seller/login', [CustomerEcoHomeController::class, 'showLoginForm'])->name('customer.ecommerce.seller.login');
Route::post('/customer-ecommerce/seller/login', [CustomerEcoHomeController::class, 'login'])->name('customer.ecommerce.seller.login.post');
Route::get('customer-ecommerce/products/order-succesfull', [CustomerEcoProductController::class, 'completePurchaseView'])->name('customer.ecommerce.products.order-succesfull');

// Rutas protegidas por el middleware 'seller'
Route::group(['prefix' => 'customer-ecommerce', 'as' => 'customer.ecommerce.', 'middleware' => 'customer'], function () {
    // Ruta de logout para vendedores (protegida)
    Route::get('/products', [CustomerEcoProductController::class, 'getProductsByFilters'])->name('products.list');
    Route::post('/save-state', [CustomerEcoSessionController::class, 'saveState'])->name('save.state');
    Route::get('/categories', [CustomerEcoCategoriesController::class, 'index'])->name('categories');
    Route::get('/cart', [CustomerEcoProductController::class, 'cart'])->name('cart');
    Route::post('/validate-coupon', [CustomerEcoProductController::class, 'validateCoupon'])->name('validate-coupon');
    Route::post('/complete-purchase', [CustomerEcoProductController::class, 'completePurchase'])->name('complete.purchase');
    Route::get('/orders/{order}/print', [CustomerEcoOrderController::class, 'printInvoice'])->name('orders.print');
    Route::post('/seller/logout', [CustomerEcoHomeController::class, 'logout'])->name('seller.logout');
    

        Route::get('orders', [CustomerEcoOrderSellerController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [CustomerEcoOrderSellerController::class, 'show'])->name('orders.show');
        Route::get('orders/{order}/print', [CustomerEcoOrderSellerController::class, 'printInvoice'])->name('orders.print');
       
    
});