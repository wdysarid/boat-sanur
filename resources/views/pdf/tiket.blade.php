<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>E-Tiket Boat Sanur</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            background-color: #1e40af;
            color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
        }

        .header h1 {
            color: white;
            font-weight: bold;
            margin: 0 0 10px 0;
            font-size: 28px;
        }

        .header p {
            color: #e0e7ff;
            font-weight: 500;
            margin: 0;
        }

        .ticket-container {
            border: 3px solid #333;
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .ticket-header {
            background-color: #2563eb;
            color: white;
            padding: 25px;
            margin-bottom: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .ticket-header h2 {
            color: white;
            font-weight: bold;
            margin: 0 0 15px 0;
            font-size: 24px;
        }

        .ticket-header p {
            color: white;
            font-weight: 600;
            font-size: 18px;
        }

        .ticket-body {
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        .ticket-info {
            flex: 1;
        }

        .qr-section {
            flex: 0 0 250px;
            text-align: center;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 2px dashed #dee2e6;
        }

        .info-section {
            background: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            border-left: 5px solid #007bff;
        }

        .passenger-list {
            margin-top: 30px;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            text-align: center;
            color: #6c757d;
            border-top: 2px solid #dee2e6;
            padding-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: white;
            padding: 12px 8px;
            font-weight: bold;
        }

        td {
            padding: 10px 8px;
        }

        .status-badge {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            background-color: #10b981;
            color: white;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
        }

        .info-value {
            color: #212529;
        }

        .qr-code-img {
            border: 3px solid #007bff;
            border-radius: 10px;
            padding: 10px;
            background: white;
            /* IMPROVED: Optimized size for simple QR codes */
            width: 180px;
            height: 180px;
        }

        .important-notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }

        /* IMPROVED: QR Code section styling for simple codes */
        .qr-info {
            background: #e3f2fd;
            border: 1px solid #2196f3;
            border-radius: 8px;
            padding: 10px;
            margin-top: 15px;
            text-align: center;
        }

        .qr-info h4 {
            color: #1976d2;
            margin: 0 0 5px 0;
            font-size: 14px;
        }

        .qr-info p {
            color: #1565c0;
            margin: 0;
            font-size: 12px;
            font-family: monospace;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>E-Ticket SanurBoat</h1>
        <p>Tanggal Cetak: {{ $today }}</p>
    </div>

    <div class="ticket-container">
        <div class="ticket-header">
            <h2>{{ $tiket->jadwal->rute_asal }} - {{ $tiket->jadwal->rute_tujuan }}</h2>
            <p>
                Kode Pemesanan: <strong>{{ $tiket->kode_pemesanan }}</strong>
            </p>
            <span class="status-badge">Dikonfirmasi</span>
        </div>

        <div class="ticket-body">
            <div class="ticket-info">
                <div class="info-section">
                    <h3 style="margin-top: 0; color: #007bff;">Informasi Perjalanan</h3>
                    <div class="info-row">
                        <span class="info-label">Kapal:</span>
                        <span class="info-value">{{ $tiket->jadwal->kapal->nama_kapal }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tanggal:</span>
                        <span
                            class="info-value">{{ \Carbon\Carbon::parse($tiket->jadwal->tanggal)->format('l, d F Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Waktu Keberangkatan:</span>
                        <span
                            class="info-value">{{ \Carbon\Carbon::parse($tiket->jadwal->waktu_berangkat)->format('H:i') }}
                            WITA</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Estimasi Tiba:</span>
                        <span class="info-value">{{ \Carbon\Carbon::parse($tiket->jadwal->waktu_tiba)->format('H:i') }}
                            WITA</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Total Penumpang:</span>
                        <span class="info-value">{{ $tiket->jumlah_penumpang }} orang</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Total Harga:</span>
                        <span class="info-value">Rp {{ number_format($tiket->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="passenger-list">
                    <h3 style="color: #007bff;">Daftar Penumpang</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>No. Identitas</th>
                                <th>Usia</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiket->penumpang as $index => $penumpang)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $penumpang->nama_lengkap }}</strong></td>
                                    <td>{{ $penumpang->no_identitas }}</td>
                                    <td>{{ $penumpang->usia }} tahun</td>
                                    <td>{{ ucfirst($penumpang->jenis_kelamin) }}</td>
                                    <td>{{ $penumpang->is_pemesan ? 'Pemesan' : 'Penumpang' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="qr-section">
                <h3 style="margin-top: 0; color: #007bff;">QR Code Boarding</h3>
                <img src="{{ $qrCodeImage }}" alt="QR Code Tiket" class="qr-code-img">

                <!-- IMPROVED: Simple QR Code information -->
                <div class="qr-info">
                    <p>{{ $tiket->kode_pemesanan }}</p>
                </div>

                <p style="font-size: 12px; margin: 15px 0 5px 0; font-weight: bold;">
                    Scan QR Code ini saat boarding
                </p>
            </div>
        </div>

        <div class="important-notice">
            <h4 style="margin-top: 0;">Penting untuk Diperhatikan:</h4>
            <ul style="margin: 10px 0; padding-left: 20px;">
                <li>Harap tiba di pelabuhan minimal <strong>30 menit sebelum keberangkatan</strong></li>
                <li>Bawa dokumen identitas asli yang sesuai dengan data pemesanan</li>
                <li>QR Code ini wajib ditunjukkan saat check-in</li>
                <li>Tiket tidak dapat dipindahtangankan</li>
                <li>Untuk perubahan jadwal, hubungi customer service minimal 2 jam sebelum keberangkatan</li>
            </ul>
        </div>

        <div class="footer">
            <p><strong>Customer Service:</strong> +62 361 123456 | Email: info@sanurboat.com</p>
            <p>&copy; {{ date('Y') }} SanurBoat - Semua hak dilindungi</p>
            <p style="font-size: 10px; margin-top: 10px;">
                Dokumen ini dicetak pada {{ $today }} dan berlaku sebagai tiket resmi
            </p>
        </div>
    </div>
</body>

</html>
