<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $product = Transaction::where('user_id', Auth::user()->id)->first()->product;
        return view('client-dashboard', ['product' => $product]);
    }

    public function download(Products $product)
    {
        $path = public_path('storage/' . $product->file);

        return response()->download($path);
    }
}
