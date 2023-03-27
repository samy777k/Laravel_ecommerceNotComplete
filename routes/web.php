<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;

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

Route::get('/', [HomeController::class , 'create'])->name('home');

Route::get('details/{slug}', [ProductsController::class , 'show'])->name('details.product');

Route::resource('carts', CartController::class);

Route::resource('checkout' , CheckoutController::class);


require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
