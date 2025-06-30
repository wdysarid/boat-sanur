<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SanurBoat</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 15px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #1e40af;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1e40af;
            color: white !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin: 20px 0;
        }
        .info-box {
            background-color: #f3f4f6;
            border-left: 4px solid #1e40af;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">SanurBoat</div>
        <div style="font-size: 20px; font-weight: bold;">Reset Password</div>
    </div>

    <p>Halo, {{ $user->nama }}! 👋</p>
    <p>Kami menerima permintaan untuk mereset password akun Anda. Jika Anda yang melakukan permintaan ini, silakan klik tombol di bawah untuk membuat password baru yang aman.</p>

    <div style="text-align: center;">
        <a href="{{ $resetUrl }}" class="button">Reset Password</a>
    </div>

    <div class="info-box">
        <strong>Informasi Penting:</strong>
        <ul style="margin-top: 10px; padding-left: 20px;">
            <li>Link ini akan kadaluarsa dalam 1 jam ({{ $expirationTime }})</li>
            <li>Jika Anda tidak meminta reset password, abaikan email ini</li>
            <li>Jangan bagikan link ini kepada siapa pun demi keamanan akun Anda</li>
            <li>Pastikan Anda membuat password yang kuat dan unik</li>
        </ul>
    </div>

    <p>Tombol tidak berfungsi? Copy dan paste URL berikut ke browser Anda:</p>
    <p style="word-break: break-all; font-size: 14px; color: #6b7280;">{{ $resetUrl }}</p>

    <div class="footer">
        <p>Salam hangat,</p>
        <p><strong>Tim SanurBoat</strong> 🌊</p>
        <p style="font-size: 12px; margin-top: 20px;">
            Email ini dikirim secara otomatis, mohon tidak membalas email ini.<br>
            © 2025 SanurBoat. All rights reserved.<br>
            🏝️ Your Gateway to Beautiful Islands
        </p>
    </div>
</body>
</html>
