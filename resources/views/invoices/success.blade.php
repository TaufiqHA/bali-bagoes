<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pembayaran Sukses</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #0d0c2d;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .container {
      max-width: 400px;
      width: 100%;
      padding: 20px;
      text-align: center;
    }
    .checkmark {
      font-size: 80px;
      color: #00d0ff;
      margin-bottom: 20px;
    }
    .title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .subtitle {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 30px;
    }
    .login-box {
      background: linear-gradient(135deg, #1e1d5c, #1b1a4c);
      padding: 20px;
      border-radius: 20px;
      margin-bottom: 30px;
      text-align: left;
    }
    .login-box h3 {
      margin: 0 0 10px 0;
      font-size: 16px;
      color: #ffffff;
      text-align: center;
    }
    .login-label {
      font-size: 14px;
      font-weight: 600;
      margin-top: 10px;
      color: #d1d1ff;
    }
    .login-value {
      font-family: monospace;
      font-size: 14px;
      background: #2b2a5d;
      padding: 10px;
      border-radius: 8px;
      word-break: break-word;
      color: #00d0ff;
      margin-top: 5px;
    }
    .thank-you {
      font-size: 22px;
      color: #00d0ff;
      font-style: italic;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="checkmark">✓</div>
    <div class="title">PEMBAYARAN</div>
    <div class="subtitle">SUKSES</div>

    <div class="login-box">
      <h3>DATA LOGIN</h3>
      <div class="login-label">LINK LOGIN:</div>
      <div class="login-value">http://localhost:8000/login</div>

      <div class="login-label">USER:</div>
      <div class="login-value">{{ $auth->email }}</div>

      <div class="login-label">PASSWORD:</div>
      <div class="login-value">{{ $password }}</div>
    </div>

    <div class="thank-you">Thank You</div>
  </div>
</body>
</html>
