<?php

use App\Http\Controllers\ProfileController;
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

Route::group(['prefix' => Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/', [App\Http\Controllers\PublicController::class, 'home'])->name('home');
    Route::get('/about', [App\Http\Controllers\PublicController::class, 'about'])->name('about');
    Route::get('/services', [App\Http\Controllers\PublicController::class, 'services'])->name('services');
    Route::get('/contact', [App\Http\Controllers\PublicController::class, 'contact'])->name('contact');
    Route::get('/contact', [App\Http\Controllers\PublicController::class, 'contact'])->name('contact');

    // Token Access Routes
    Route::get('/store/access', [App\Http\Controllers\TokenController::class, 'showForm'])->name('token.form');
    Route::post('/store/validate', [App\Http\Controllers\TokenController::class, 'validateToken'])->name('token.validate');

    // Protected Store Route
    Route::get('/store', [App\Http\Controllers\PublicController::class, 'store'])->name('store')->middleware('check.token');

    // Cart Routes
    Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout')->middleware('check.token');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::post('/dashboard/exchange-rate', [App\Http\Controllers\DashboardController::class, 'updateExchangeRate'])->middleware(['auth', 'verified'])->name('dashboard.update-exchange-rate');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Products Management
        Route::get('/products/import-export', function () {
            return view('products.import-export');
        })->name('products.import-export');
        // Product Import
        Route::post('/products/import', [App\Http\Controllers\ProductController::class, 'import'])->name('products.import');
        // Product Export
        Route::get('/products/export', [App\Http\Controllers\ProductController::class, 'export'])->name('products.export');
        Route::get('/products/export-pdf', [App\Http\Controllers\ProductController::class, 'exportPdf'])->name('products.export-pdf');

        // Token Generation
        Route::get('/tokens', [App\Http\Controllers\TokenController::class, 'index'])->name('tokens.index');
        Route::post('/tokens/generate', [App\Http\Controllers\TokenController::class, 'generate'])->name('tokens.generate');

        // User Management
        Route::resource('users', App\Http\Controllers\UserController::class)->middleware(['role:Admin|Branch Store']);

        // Product Management
        // Product Management
        Route::post('/products/lookup', [App\Http\Controllers\ProductController::class, 'lookup'])->name('products.lookup');
        Route::resource('products', App\Http\Controllers\ProductController::class);

        // Category Management
        Route::resource('categories', App\Http\Controllers\CategoryController::class);

        // Order Management
        Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/{order}/export', [App\Http\Controllers\OrderController::class, 'export'])->name('orders.export');
        Route::put('/orders/{order}', [App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/orders/{order}/quotation', [App\Http\Controllers\OrderController::class, 'generateQuotation'])->name('orders.quotation');
        Route::get('/orders/{order}/invoice-pdf', [App\Http\Controllers\OrderController::class, 'generateInvoice'])->name('orders.invoice-pdf');
        Route::get('/orders/{order}/export-invoice', [App\Http\Controllers\OrderController::class, 'exportInvoice'])->name('orders.export-invoice');
        Route::put('/orders/{order}/invoice-details', [App\Http\Controllers\OrderController::class, 'updateInvoiceDetails'])->name('orders.update-invoice-details');

        // Order Item Management
        Route::post('/orders/{order}/items', [App\Http\Controllers\OrderController::class, 'addProduct'])->name('orders.add-product');
        Route::put('/orders/{order}/items/{item}', [App\Http\Controllers\OrderController::class, 'updateItem'])->name('orders.update-item');
        Route::delete('/orders/{order}/items/{item}', [App\Http\Controllers\OrderController::class, 'removeItem'])->name('orders.remove-item');
    });

    require __DIR__ . '/auth.php';
});
