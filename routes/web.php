<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductsController::class, 'index'])->name('home');

Route::get('/checkout/{product:id}', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/clientArea', function() {
    return view('client-dashboard');
});