<?php

namespace App\Services\Payments;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use App\Services\Payments\PaymentGatewayInterface;

class XenditGateway implements PaymentGatewayInterface
{
    protected $invoiceApi;

    public function __construct()
    {
        \Xendit\Configuration::setXenditKey(config('services.xendit.secret_key'));
        $this->invoiceApi = new InvoiceApi();
    }

    public function process(Request $request, Products $product, Invoice $invoice): mixed
    {
        $externalId = 'order-' . Str::uuid();

        $order = Order::create([
            'user_id' => $request->name . Str::random(),
            'external_id' => $externalId,
            'amount' => $product->price,
            'status' => 'PENDING',
        ]);

        $params = [
            'external_id' => $externalId,
            'amount' => $product->price,
            'description' => 'Pembayaran Order #' . $product->id,
            'invoice_duration' => 3600,
            'currency' => 'IDR',
            'customer' => [
                'given_names' => $request->name,
                'email' => $request->email,
            ],
            'success_redirect_url' => route('callback.terima', ['id' => $invoice->id]),
        ];

        $xenditInvoice = $this->invoiceApi->createInvoice($params);
        $order->update(['invoice_id' => $xenditInvoice['id']]);

        return redirect($xenditInvoice['invoice_url']);
    }
}
