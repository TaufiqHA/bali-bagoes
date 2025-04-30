<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice->invoice }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .invoice-header {
            background-color: #4e73df;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .invoice-body {
            padding: 30px;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .detail-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: 600;
            width: 200px;
            color: #555;
        }
        .detail-value {
            flex: 1;
        }
        .status-valid {
            color: #28a745;
            font-weight: 600;
        }
        .status-expired {
            color: #dc3545;
            font-weight: 600;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
        .payment-form {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
            font-size: 14px;
        }
        .btn-pay {
            background-color: #4e73df;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        .btn-pay:hover {
            background-color: #3a5bc7;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>INVOICE #{{ $invoice->invoice }}</h1>
        </div>
        
        <div class="invoice-body">
            <div class="invoice-details">
                <div class="detail-row">
                    <div class="detail-label">Produk</div>
                    <div class="detail-value">{{ $invoice->product->name }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Harga</div>
                    <div class="detail-value">Rp {{ number_format($invoice->transaksi, 0, ',', '.') }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Tanggal Jatuh Tempo</div>
                    <div class="detail-value">{{ $invoice->jatuh_tempo->format('d F Y') }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Status Invoice</div>
                    <div class="detail-value">
                        @if($invoice->link_expires_at->isPast())
                            <span class="status-expired">KADALUWARSA</span> (sejak {{ $invoice->link_expires_at->format('d M Y H:i') }})
                        @else
                            <span class="status-valid">VALID</span> hingga {{ $invoice->link_expires_at->format('d F Y H:i') }}
                        @endif
                    </div>
                </div>
            </div>

            <div class="payment-form">
                <h3>Informasi Pembayaran</h3>
                <form action="{{ route('invoice.process', ['id' => $invoice->product->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                    <input type="hidden" name="payment_gateway" value="{{ $invoice->payment_gateway }}">
                    
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" required placeholder="Masukkan alamat email">
                    </div>
                    
                    <button type="submit" class="btn-pay">Bayar Sekarang</button>
                </form>
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>