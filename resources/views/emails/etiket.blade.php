<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Tiket SanurBoat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
        }
        .content {
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .ticket-info {
            background: white;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin: 15px 0;
        }
        .button {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            color: #666;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>E-Tiket SanurBoat</h1>
        <p>Pembayaran Anda telah dikonfirmasi</p>
    </div>

    <div class="content">
        <h2>Selamat! Tiket Anda telah dikonfirmasi</h2>
        <p>Terima kasih telah melakukan pembayaran. Berikut adalah detail tiket Anda:</p>

        <div class="ticket-info">
            <strong>Kode Pemesanan:</strong> {{ $tiket->kode_pemesanan }}<br>
            <strong>Rute:</strong> {{ $tiket->jadwal->rute_asal }} → {{ $tiket->jadwal->rute_tujuan }}<br>
            <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($tiket->jadwal->tanggal)->format('d F Y') }}<br>
            <strong>Waktu Keberangkatan:</strong> {{ \Carbon\Carbon::parse($tiket->jadwal->waktu_berangkat)->format('H:i') }} WITA<br>
            <strong>Jumlah Penumpang:</strong> {{ $tiket->jumlah_penumpang }} orang<br>
            <strong>Total Harga:</strong> Rp {{ number_format($tiket->total_harga, 0, ',', '.') }}
        </div>

        <p><strong>Catatan Penting:</strong></p>
        <ul>
            <li>Harap tiba di pelabuhan minimal 30 menit sebelum keberangkatan</li>
            <li>Bawa dokumen identitas yang sesuai dengan data pemesanan</li>
            <li>E-tiket PDF terlampir dalam email ini</li>
        </ul>
    </div>

    <div class="footer">
        <p>Terima kasih telah memilih SanurBoat</p>
        <p>Customer Service: +62 361 123456 | Email: info@sanurboat.com</p>
        <p>&copy; {{ date('Y') }} SanurBoat - Semua hak dilindungi</p>
    </div>
</body>
</html>
