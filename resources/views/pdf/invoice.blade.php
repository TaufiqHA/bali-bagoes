<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            margin-top: 20px;
            font-size: 16px;
        }
        .footer {
            position: absolute;
            bottom: 30px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: gray;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">INVOICE</div>
        <div>{{ now()->format('d M Y') }}</div>
    </div>

    <div class="content">
        <p><strong>Nama Produk:</strong> {{ $product->name }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p><strong>Nomor Invoice:</strong> INV-{{ now()->format('Ymd') }}-{{ str_pad($no, 4, '0', STR_PAD_LEFT) }}</p>
    </div>

    <div class="footer">
        &copy; {{ now()->year }} Your Company Name
    </div>

</body>
</html>
