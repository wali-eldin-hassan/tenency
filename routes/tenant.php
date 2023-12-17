<?php

declare(strict_types=1);

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tenants\CartController;
use App\Http\Controllers\Tenants\StoreController;
use App\Http\Controllers\Tenants\OrdersController;
use App\Http\Controllers\Tenants\CheckoutController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Tenants\Dashboard\ProfileController;
use App\Http\Controllers\Tenants\Dashboard\ProductsController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Tenants\Dashboard\CustomersController;
use App\Http\Controllers\Tenants\Dashboard\CategoriesController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::group([
    'as' => 'tenant.',
    'middleware' => [
        'web',
        InitializeTenancyByDomain::class,
        PreventAccessFromCentralDomains::class,
    ],
], function () {
    /**
     * Store Routes
     */
    Route::redirect('/home', '/');

    Route::get('/', function () {
        return view('tenants.store.home', [
            'products' => Product::where('stock', '>', 1)->inRandomOrder()->take(4)->get(),
        ]);
    })->middleware(['tenant.approved'])->name('home');

    Route::get('/store', [StoreController::class, 'index'])->name('sotre.index');
    Route::get('/store/{category}', [StoreController::class, 'show'])->name('sotre.show');
    Route::get('/store/{category}/{product}', [ProductsController::class, 'show'])->name('products.show');
    Route::middleware(['auth'])->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
        Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    });

    /**
    * Cart Routes
    */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/edit', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/destroy', [CartController::class, 'delete'])->name('cart.destroy');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    /**
    * Dashboard Routes
    */
    Route::middleware(['auth', 'owner'])->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::view('/', 'tenants.dashboard.index')->name('dashboard');
            Route::resource('/products', ProductsController::class);
            Route::resource('/categories', CategoriesController::class);
            Route::controller(CustomersController::class)->group(function () {
                Route::get('/customers', 'index')->name('customers.index');
                Route::get('/customers/create', 'create')->name('customers.create');
                Route::post('/customers', 'store')->name('customers.store');
                Route::patch('/customers/{user}', 'update')->name('customers.update');
            });
        });

        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/tenant-auth.php';
});
