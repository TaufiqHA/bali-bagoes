<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Products $product)
    {
        return view('checkout', ['product' => $product]);
    }
}
