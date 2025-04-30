<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sukses</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .success-container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
        }
        .success-header {
            background-color: #4e73df;
            color: white;
            padding: 25px;
        }
        .success-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .success-body {
            padding: 30px;
        }
        .success-icon {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .success-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #28a745;
        }
        .login-data {
            margin-top: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            text-align: left;
        }
        .login-data h3 {
            margin-top: 0;
            color: #4e73df;
        }
        .login-info {
            margin-bottom: 15px;
        }
        .login-label {
            font-weight: 600;
            color: #555;
        }
        .login-value {
            margin-top: 5px;
            padding: 10px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: monospace;
            word-break: break-all;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-header">
            <h1>PEMBAYARAN</h1>
        </div>
        
        <div class="success-body">
            <div class="success-icon">✓</div>
            <div class="success-title">SUKSES</div>
            
            <div class="login-data">
                <h3>DATA LOGIN</h3>
                
                <div class="login-info">
                    <div class="login-label">LINK LOGIN:</div>
                    <div class="login-value">http://localhost:8000/login</div>
                </div>
                
                <div class="login-info">
                    <div class="login-label">Email:</div>
                    <div class="login-value">{{ $auth->email }}</div>
                </div>

                <div class="login-info">
                    <div class="login-label">Password:</div>
                    <div class="login-value">{{ $password }}</div>
                </div>
            </div>
            
            <p style="margin-top: 30px; font-size: 18px;">Thank You</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>