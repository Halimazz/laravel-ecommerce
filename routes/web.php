<?php

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//make route with resource
Route::resource('products', ProductController::class);
Route::post('/products/create', [ProductController::class, 'store_product'])->name('store_product');

Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::patch('/cart/{cart}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/{cart}', [CartController::class, 'destroyCart'])->name('cart.destroy');

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

Route::resource('orders', OrderController::class);


