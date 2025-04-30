<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Request $request, $invoiceNumber)
    {
        if (!$request->hasValidSignature()) {
            abort(403, 'Link invoice telah kadaluwarsa');
        }
        
        $invoice = Invoice::where('invoice', $invoiceNumber)->firstOrFail();
        
        return view('invoices.show', compact('invoice'));
    }

}
