<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SanurBoat</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #374151;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .header {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            padding: 10px;
        }

        .logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 8px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header h2 {
            font-size: 16px;
            font-weight: 400;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
            background: white;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
        }

        .message {
            font-size: 16px;
            color: #6B7280;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .button-container {
            text-align: center;
            margin: 35px 0;
        }

        .button {
            display: inline-block;
            background: #3B82F6;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .warning {
            background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
            border: 1px solid #F59E0B;
            padding: 20px;
            border-radius: 12px;
            margin: 25px 0;
            position: relative;
        }

        .warning::before {
            content: '⚠️';
            position: absolute;
            top: -10px;
            left: 20px;
            background: #F59E0B;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .warning-title {
            font-weight: 600;
            color: #92400E;
            margin-bottom: 10px;
            margin-left: 20px;
        }

        .warning ul {
            margin-left: 20px;
            color: #92400E;
        }

        .warning li {
            margin-bottom: 5px;
        }

        .url-box {
            background: #F3F4F6;
            border: 2px dashed #D1D5DB;
            padding: 15px;
            border-radius: 8px;
            word-break: break-all;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            color: #374151;
            margin: 20px 0;
        }

        .signature {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #E5E7EB;
        }

        .signature-text {
            font-size: 16px;
            color: #374151;
        }

        .team-name {
            font-weight: 600;
            color: #1E40AF;
        }

        .footer {
            background: #F9FAFB;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #E5E7EB;
        }

        .footer-text {
            font-size: 12px;
            color: #9CA3AF;
            margin-bottom: 8px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #E5E7EB, transparent);
            margin: 20px 0;
        }

        /* Responsive */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .email-container {
                border-radius: 12px;
            }

            .header {
                padding: 30px 20px;
            }

            .content {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .button {
                padding: 14px 28px;
                font-size: 15px;
            }

            .logo {
                width: 70px;
                height: 70px;
            }

            .logo img {
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Sanur Boat</h1>
            <h2>Reset Password</h2>
        </div>

        <div class="content">
            <div class="greeting">
                Halo, {{ $user->nama }}! 👋
            </div>

            <div class="message">
                Kami menerima permintaan untuk mereset password akun Anda. Jika Anda yang melakukan permintaan ini, silakan klik tombol di bawah untuk membuat password baru yang aman.
            </div>

            <div class="button-container">
                <a href="{{ $resetUrl }}" class="button">
                    Reset Password
                </a>
            </div>

            <div class="warning">
                <div class="warning-title">Informasi Penting:</div>
                <ul>
                    <li>Link ini akan <strong>kadaluarsa dalam 1 jam</strong> ({{ $expiresAt->format('d/m/Y H:i') }} WIB)</li>
                    <li>Jika Anda tidak meminta reset password, <strong>abaikan email ini</strong></li>
                    <li>Jangan bagikan link ini kepada siapa pun demi keamanan akun Anda</li>
                    <li>Pastikan Anda membuat password yang kuat dan unik</li>
                </ul>
            </div>

            <div class="message">
                <strong>Tombol tidak berfungsi?</strong> Copy dan paste URL berikut ke browser Anda:
            </div>

            <div class="url-box">
                {{ $resetUrl }}
            </div>

            <div class="divider"></div>

            <div class="signature">
                <div class="signature-text">
                    Salam hangat,<br>
                    <span class="team-name">Tim SanurBoat</span> 🌊
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="footer-text">
                Email ini dikirim secara otomatis, mohon tidak membalas email ini.
            </div>
            <div class="footer-text">
                © {{ date('Y') }} SanurBoat. All rights reserved.
            </div>
            <div class="footer-text">
                🏝️ Your Gateway to Beautiful Islands
            </div>
        </div>
    </div>
</body>
</html>
