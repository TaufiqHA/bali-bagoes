<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Settings\PageSettings;
use App\Settings\PaymentSettings;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $data = [
            'brand' => app(PageSettings::class)->brand,
            'heading' => app(PageSettings::class)->heading,
            'description' => app(PageSettings::class)->description,
        ];
        return view('home', ['products' => $products, 'data' => $data]);
    }
}
