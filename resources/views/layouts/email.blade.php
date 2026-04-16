<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to StoqFlow</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #111111;
            margin: 0;
            padding: 0;
            background-color: #f7fbf5;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: linear-gradient(145deg, #ffffff 0%, #f7fbf5 100%);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        .email-header {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            padding: 35px 40px 45px;
            text-align: center;
            position: relative;
        }
        .email-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #7ed957 0%, #9bea78 50%, #7ed957 100%);
        }
        .logo-container {
            margin-bottom: 10px;
        }
        .email-body {
            padding: 40px;
            text-align: center;
        }
        .email-body h1 {
            color: #000000;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }
        .email-body p {
            margin-bottom: 24px;
            font-size: 16px;
            color: #2f3a33;
            line-height: 1.7;
        }
        .btn {
            display: inline-block;
            padding: 16px 36px;
            background: linear-gradient(135deg, #7ed957 0%, #69c148 100%);
            color: #000000;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 16px;
            margin: 20px 0 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(126, 217, 87, 0.25);
            border: none;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(126, 217, 87, 0.35);
        }
        .features {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }
        .feature {
            text-align: center;
            padding: 0 10px;
            width: 33%;
        }
        .feature-icon {
            background-color: rgba(126, 217, 87, 0.16);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 20px;
            color: #2f7d16;
        }
        .feature-text {
            font-size: 14px;
            color: #2f3a33;
        }
        .email-footer {
            padding: 30px 40px;
            background-color: #f4f8f1;
            font-size: 14px;
            color: #5d6b61;
            text-align: center;
            border-top: 1px solid #d9e6d1;
        }
        .email-footer p {
            margin: 6px 0;
        }
        .separator {
            height: 1px;
            background-color: #d9e6d1;
            margin: 15px 0;
        }
        .contact-info {
            margin-top: 15px;
            font-size: 13px;
            color: #7a867d;
        }
        .social-links {
            margin: 20px 0 10px;
        }
        .social-link {
            display: inline-block;
            margin: 0 8px;
            width: 32px;
            height: 32px;
            background-color: #000000;
            border-radius: 50%;
            color: white;
            line-height: 32px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
