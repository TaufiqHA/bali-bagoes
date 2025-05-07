<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Invoice {{ $invoice->invoice }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0d0c2d;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
        }
        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 40px;
            margin-bottom: 30px;
        }
        .box {
            background-color: #1c1b47;
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 20px;
        }
        .box h4 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #b0b3d6;
        }
        .invoice-value {
            font-size: 18px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            margin-bottom: 5px;
            color: #b0b3d6;
        }
        .form-group input {
            width: 95%;
            padding: 12px;
            border-radius: 20px;
            border: none;
            font-size: 14px;
            outline: none;
            background: #c0c2d8;
            color: #000;
        }
        .btn-pay {
            width: 100%;
            padding: 14px;
            background: #ff6600;
            border: none;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">PEMBAYARAN</div>

        <div class="box">
            <h4>RINGKASAN PESANAN</h4>
            <p>No Invoice: <span class="invoice-value">{{ $invoice->invoice }}</span></p>
            <p>Data Transaksi</p>
            <p>Total: <span class="invoice-value">Rp {{ number_format($invoice->transaksi, 0, ',', '.') }}</span></p>
        </div>

        <div class="box">
            <h4>INFORMASI PEMBAYARAN</h4>
            <form action="{{ route('invoice.process', ['id' => $invoice->product->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                <input type="hidden" name="payment_gateway" value="{{ $invoice->payment_gateway }}">

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Masukkan email">
                </div>

                <button type="submit" class="btn-pay">Bayar Sekarang</button>
            </form>
        </div>
    </div>
</body>
</html>
