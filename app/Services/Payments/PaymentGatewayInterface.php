<?php

namespace App\Services\Payments;

use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function process(Request $request, Products $product, Invoice $invoice): mixed;
}
