<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderContrller;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\backoffice_order;
use App\Http\Controllers\backoffice_report;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::resource('/', MenuController::class);

Auth::routes();

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'admin'
], function () {
    Route::resource('/profile', ProfileController::class);
    Route::resource('/backoffice_report', backoffice_report::class);
    Route::resource('/backoffice_order', backoffice_order::class);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::post('/get_order_transaction', [backoffice_order::class, 'get_order_transaction'])->name('get_order_transaction');
    Route::post('/get_product', [ProductController::class, 'get_product'])->name('get_product');
    Route::post('/get_product_cart', [CartController::class, 'get_products'])->name('get_product_cart');
    Route::patch('/finish_order_driver/{id}', [TransactionController::class, 'finish_order_driver'])->name('transaction.finish_order_driver');
});

Route::resource('/order', OrderContrller::class);
Route::resource('/checkout', CheckoutController::class);
Route::resource('cart', CartController::class);
Route::post('/get_product_in_cart', [CartController::class, 'get_product_in_cart'])->name('cart.get_product_in_cart');
Route::patch('/finish_order_customer/{id}', [TransactionController::class, 'finish_order_customer'])->name('finish_order_customer');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
