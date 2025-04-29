<!DOCTYPE html>
<html>
<head>
    <title>Bayar Sekarang</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    <h1>Memproses Pembayaran...</h1>

    <script type="text/javascript">
        window.onload = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran Berhasil!");
                    window.location.href = '/callback/terima'; // redirect ke halaman sukses kalau mau
                },
                onPending: function(result) {
                    alert("Pembayaran pending.");
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                }
            });
        };
    </script>
</body>
</html>
