<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseMovementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__ . '/ecommerce.php';
require __DIR__ . '/customer-ecommerce.php';

Auth::routes();
Route::middleware(['web', 'prevent.seller.access'])->group(function () {
    Route::get('/', [HomeController::class, 'root'])->name('roow');
    Route::get('/dynamic-dashboard', [HomeController::class, 'dynamicDashboard'])->name('dynamic.dashboard');

    //Update User Details
    Route::post('/update-profile', [HomeController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

    // Rutas para Customer
    Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/create', [CustomerController::class, 'create'])->name('create');
        Route::get('/{id}', [CustomerController::class, 'show'])->name('show');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('edit');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
        Route::put('/{id}', [CustomerController::class, 'update'])->name('update');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('destroy');
    });

    // Rutas para Seller
    Route::group(['prefix' => 'sellers', 'as' => 'sellers.'], function () {
        Route::get('/', [SellerController::class, 'index'])->name('index');
        Route::get('/create', [SellerController::class, 'create'])->name('create');
        Route::get('/{id}', [SellerController::class, 'show'])->name('show');
        Route::post('/', [SellerController::class, 'store'])->name('store');
        Route::put('/{id}', [SellerController::class, 'update'])->name('update');
        Route::delete('/{id}', [SellerController::class, 'destroy'])->name('destroy');
    });

    Route::resource('states', StateController::class);

    Route::resource('products', ProductController::class);

    // Routes for updating product prices and logging price history
    Route::get('products/{product}/prices/edit', [ProductPriceController::class, 'edit'])->name('products.prices.edit');
    Route::put('products/{product}/prices', [ProductPriceController::class, 'update'])->name('products.prices.update');
    Route::delete('mass-destroy/products', [ProductController::class, 'massDestroy'])->name('products.massDestroy');
    Route::post('mass-restore/products', [ProductController::class, 'massRestore'])->name('products.massRestore');
    Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    // Routes for updating product prices and logging price history

    Route::prefix('administration')->name('administration.')->group(function () {
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('orders/{order}/print', [OrderController::class, 'printInvoice'])->name('orders.print');
        Route::get('orders/{id}/update-status', [OrderController::class, 'showUpdateStatusForm'])->name('orders.updateStatusForm');
        Route::put('orders/update-status/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('orders/edit/{id}', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
        Route::post('orders/update-tracking', [OrderController::class, 'updateTracking'])->name('orders.updateTracking');
        Route::get('modified/orders', [OrderController::class, 'modifiedOrders'])->name('orders.modified');
        Route::get('/index-product-sales', [OrderController::class, 'indexProductsSales'])->name('products.sales.index');
        Route::get('products/sales/export', [OrderController::class, 'exportProductsSales'])->name('products.sales.export');
        Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('export-excel/orders', [OrderController::class, 'exportExcel'])->name('orders.exportExcel');

        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::get('/inventory/export', [InventoryController::class, 'export'])->name('inventory.export');
        Route::get('/inventory/kardex', [KardexController::class, 'index'])->name('kardex.index');


        Route::prefix('warehouse')->name('warehouse.')->group(function () {
            Route::get('/index', [WarehouseController::class, 'index'])->name('index');
            Route::get('/create', [WarehouseController::class, 'create'])->name('create');
            Route::post('/store', [WarehouseController::class, 'store'])->name('store');
            Route::get('/upload', [WarehouseMovementController::class, 'showUploadForm'])->name('upload');
            Route::post('/import', [WarehouseMovementController::class, 'importExcel'])->name('import');
            Route::get('orders/edit/{id}', [OrderController::class, 'editWarehouse'])->name('orders.edit');
            Route::put('orders/update/{id}', [OrderController::class, 'updateWarehouse'])->name('orders.update');
            Route::get('export', [WarehouseController::class, 'export'])->name('export');
        });
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/create-users', [UserController::class, 'create'])->name('users.create');
    Route::get('/edit-users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');


    Route::resource('categories', CategoryController::class);
    // Rutas para proveedores
    Route::resource('suppliers', SupplierController::class);
    Route::resource('purchase_orders', PurchaseOrderController::class);


    // Rutas individuales (si necesitas más control o agregar rutas adicionales)
    Route::get('coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');
    Route::get('{any}', [HomeController::class, 'index'])->name('index');
});


//Language Translation
// Route::get('index/{locale}', [HomeController::class, 'lang']);
