<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/checkout', function() {
    return view('checkout');
})->name('checkout');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/clientArea', function() {
    return view('client-dashboard');
});