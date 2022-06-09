<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

// Route::get('/', function () {
//     return view('home_menu');
// });

Route::resource('/', MenuController::class);

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::post('/get_product', [ProductController::class, 'get_product'])->name('get_product');
    Route::post('/get_product_cart', [CartController::class, 'get_products'])->name('get_product_cart');
});

Route::post('/get_product_in_cart', [CartController::class, 'get_product_in_cart'])->name('cart.get_product_in_cart');
Route::resource('cart', CartController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/',);
