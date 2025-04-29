<?php

use App\Models\Products;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\callbackController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MidtransCallbackController;

Route::get('/', [ProductsController::class, 'index'])->name('home');

Route::get('/checkout/{id}', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');

Route::post('/checkout/{id}', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// Midtrans callback
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'receive']);

// callback
Route::get('/callback/terima', [callbackController::class, 'terima'])->name('callback.terima');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/clientArea', [ClientController::class, 'index'])->middleware(['auth'])->name('client-dashboard'); 
Route::get('/download/{product:id}', [ClientController::class, 'download'])->middleware(['auth'])->name('download'); 