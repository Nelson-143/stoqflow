<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email | StoqFlow</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fbf5;
            color: #111111;
            line-height: 1.6;
            margin: 0;
            padding: 24px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 32px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #7ed957;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }
        .header h2 {
            margin: 0;
            color: #000000;
        }
        .subtext {
            color: #4b5b50;
            margin-top: 8px;
        }
        .button {
            display: inline-block;
            padding: 14px 24px;
            background-color: #7ed957;
            color: #000000;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .link-box {
            word-break: break-all;
            background: #f4f8f1;
            border: 1px solid #d9e6d1;
            border-radius: 8px;
            padding: 12px;
            color: #2f3a33;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6b756e;
            text-align: center;
        }
        .footer a {
            color: #2f7d16;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Verify Your Email</h2>
            <p class="subtext">Control your stock. Master your flow.</p>
        </div>
        <p>Hello,</p>
        <p>Welcome to StoqFlow. Please verify your email address to complete your account setup and start using the platform with confidence.</p>
        <p style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">Verify Email</a>
        </p>
        <p>This verification link will expire in 24 hours. If the button does not work, copy and paste this link into your browser:</p>
        <p class="link-box">{{ $verificationUrl }}</p>
        <p>If you did not create this account, you can safely ignore this email.</p>
        <div class="footer">
            <p>Powered by RomanSofts.</p>
            <p>Thank you,<br>The StoqFlow Team</p>
            <p><a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
        </div>
    </div>
</body>
</html>
