<?php

use App\Models\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MidtransCallbackController;

Route::get('/', [ProductsController::class, 'index'])->name('home');

Route::get('/checkout/{id}', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');

Route::post('/checkout/{id}', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

// Midtrans callback
Route::post('/midtrans/callback', [MidtransCallbackController::class, 'receive']);
Route::get('/midtrans/terima', [MidtransCallbackController::class, 'terima']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/clientArea', function() {
    return view('client-dashboard');
});