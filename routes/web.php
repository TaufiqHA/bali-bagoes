<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/checkout', function() {
    return view('checkout');
});

Route::get('/login', function () {
    return view('login');
});