<!DOCTYPE html>
<html>
<head>
    <title>Akun Anda Berhasil Dibuat</title>
</head>
<body>
    <h2>Halo {{ $user->name }},</h2>

    <p>Selamat! Akun Anda telah berhasil dibuat. Berikut informasi akun Anda:</p>

    <p>
        <strong>Email:</strong> {{ $user->email }}<br>
        <strong>Password:</strong> {{ $password }}
    </p>

    <p>Silakan login ke website kami dan segera ganti password Anda.</p>

    <a href="{{ url('/login') }}">Login Disini</a>

    <p>Terima kasih.</p>
</body>
</html>
