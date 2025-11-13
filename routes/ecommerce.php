<?php

use App\Http\Controllers\Eco\EcoCategoriesController;
use App\Http\Controllers\Eco\EcoCustomerController;
use App\Http\Controllers\Eco\EcoHomeController;
use App\Http\Controllers\Eco\EcoOrderController;
use App\Http\Controllers\Eco\EcoOrderSellerController;
use App\Http\Controllers\Eco\EcoProductController;
use App\Http\Controllers\Eco\EcoSessionController;
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
Route::get('/ecommerce/seller/login', [EcoHomeController::class, 'showLoginForm'])->name('ecommerce.seller.login');
Route::post('/ecommerce/seller/login', [EcoHomeController::class, 'login'])->name('ecommerce.seller.login.post');
Route::get('ecommerce/products/order-succesfull', [EcoProductController::class, 'completePurchaseView'])->name('ecommerce.products.order-succesfull');

// Rutas protegidas por el middleware 'seller'
Route::group(['prefix' => 'ecommerce', 'as' => 'ecommerce.', 'middleware' => 'seller'], function () {
    // Ruta de logout para vendedores (protegida)
    Route::get('/products', [EcoProductController::class, 'getProductsByFilters'])->name('products.list');
    Route::post('/save-state', [EcoSessionController::class, 'saveState'])->name('save.state');
    Route::get('/categories', [EcoCategoriesController::class, 'index'])->name('categories');
    Route::get('/cart', [EcoProductController::class, 'cart'])->name('cart');
    Route::post('/validate-coupon', [EcoProductController::class, 'validateCoupon'])->name('validate-coupon');
    Route::post('/complete-purchase', [EcoProductController::class, 'completePurchase'])->name('complete.purchase');
    Route::get('/orders/{order}/print', [EcoOrderController::class, 'printInvoice'])->name('orders.print');
    Route::post('/seller/logout', [EcoHomeController::class, 'logout'])->name('seller.logout');


    Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
        Route::get('/', [EcoCustomerController::class, 'index'])->name('index');
        Route::get('/create', [EcoCustomerController::class, 'create'])->name('create');
        Route::get('/{id}', [EcoCustomerController::class, 'show'])->name('show');
        Route::post('/', [EcoCustomerController::class, 'store'])->name('store');
        Route::get('edit/{id}', [EcoCustomerController::class, 'edit'])->name('edit');
        Route::put('/{id}', [EcoCustomerController::class, 'update'])->name('update');
        Route::delete('/{id}', [EcoCustomerController::class, 'destroy'])->name('destroy');
        
    });
    

        Route::get('orders', [EcoOrderSellerController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [EcoOrderSellerController::class, 'show'])->name('orders.show');
        Route::get('orders/{order}/print', [EcoOrderSellerController::class, 'printInvoice'])->name('orders.print');
        Route::get('orders/{id}/update-status', [EcoOrderSellerController::class, 'showUpdateStatusForm'])->name('orders.updateStatusForm');
        Route::put('orders/update-status/{id}', [EcoOrderSellerController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('orders/edit/{id}', [EcoOrderSellerController::class, 'edit'])->name('orders.edit');
        Route::put('orders/update/{id}', [EcoOrderSellerController::class, 'update'])->name('orders.update');
        Route::post('orders/update-tracking', [EcoOrderSellerController::class, 'updateTracking'])->name('orders.updateTracking');
        Route::get('modified/orders', [EcoOrderSellerController::class, 'modifiedOrders'])->name('orders.modified');
    
});