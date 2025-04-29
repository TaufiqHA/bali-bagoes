<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Settings\PaymentSettings;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('home', ['products' => $products]);
    }
}
