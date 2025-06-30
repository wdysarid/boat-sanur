<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>E-Tiket Boat Sanur</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }

        .boarding-pass {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 2px solid #0066cc;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Simple Header */
        .simple-header {
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #0066cc;
            background: white;
        }

        .main-title {
            font-size: 32px;
            font-weight: bold;
            color: #0066cc;
            margin: 0 0 10px 0;
            letter-spacing: 2px;
        }

        .print-date {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        /* Main Content Container */
        .main-content {
            padding: 25px;
        }

        /* Flight Info Section */
        .flight-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px dashed #0066cc;
        }

        .route-display {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .booking-code {
            background: #0066cc;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin: 5px 10px;
            font-size: 14px;
        }

        .status-confirmed {
            background: #28a745;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin: 5px;
            font-size: 12px;
        }

        /* Two Column Layout */
        .content-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }

        .left-column {
            display: table-cell;
            width: 65%;
            vertical-align: top;
            padding-right: 20px;
        }

        .right-column {
            display: table-cell;
            width: 35%;
            vertical-align: top;
            text-align: center;
        }

        /* Journey Information */
        .journey-details {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            color: #0066cc;
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 15px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #0066cc;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-row {
            display: table-row;
            margin-bottom: 8px;
        }

        .info-label {
            display: table-cell;
            font-weight: bold;
            color: #555;
            padding: 6px 10px 6px 0;
            width: 40%;
        }

        .info-value {
            display: table-cell;
            color: #222;
            padding: 6px 0;
            font-weight: 500;
        }

        /* QR Code Section */
        .qr-section {
            background: #f8f9fa;
            border: 2px solid #0066cc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .qr-title {
            color: #0066cc;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .qr-code-img {
            width: 150px;
            height: 150px;
            border: 2px solid #0066cc;
            border-radius: 8px;
            background: white;
            padding: 5px;
            margin: 0 auto 10px auto;
            display: block;
        }

        .qr-instruction {
            font-size: 11px;
            color: #666;
            margin-top: 8px;
            line-height: 1.3;
        }

        /* Important Notice */
        .important-notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-left: 4px solid #f39c12;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
        }

        .notice-title {
            color: #856404;
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 10px 0;
        }

        .notice-list {
            margin: 0;
            padding-left: 20px;
            color: #856404;
        }

        .notice-list li {
            margin-bottom: 5px;
            line-height: 1.4;
        }

        /* Passenger Table */
        .passenger-section {
            margin-top: 25px;
        }

        .passenger-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }

        .passenger-table th {
            background: #0066cc;
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #0066cc;
        }

        .passenger-table td {
            padding: 8px;
            border: 1px solid #ddd;
            background: white;
        }

        .passenger-table tr:nth-child(even) td {
            background: #f8f9fa;
        }

        .passenger-name {
            font-weight: bold;
            color: #0066cc;
        }

        .booker-badge {
            background: #17a2b8;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            margin-left: 5px;
        }

        /* Footer */
        .footer {
            background: #f8f9fa;
            border-top: 2px solid #0066cc;
            padding: 15px 20px;
            text-align: center;
            margin-top: 25px;
        }

        .contact-info {
            font-size: 12px;
            color: #0066cc;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .copyright {
            font-size: 10px;
            color: #666;
            margin: 5px 0;
        }

        .validity-note {
            font-size: 9px;
            color: #999;
            margin-top: 5px;
            font-style: italic;
        }

        /* Print Optimizations */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .boarding-pass {
                box-shadow: none;
                border: 2px solid #0066cc;
            }
        }
    </style>
</head>

<body>
    <div class="boarding-pass">
        <!-- Simple Header -->
        <div class="simple-header">
            <h1 class="main-title">SANUR BOAT</h1>
            <p class="print-date">Tanggal Cetak: {{ $today }}</p>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Flight Header -->
            <div class="flight-header">
                <div class="route-display">{{ $tiket->jadwal->rute_asal }} → {{ $tiket->jadwal->rute_tujuan }}</div>
                <div class="booking-code">{{ $tiket->kode_pemesanan }}</div>
                <div class="status-confirmed">DIKONFIRMASI</div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Left Column - Journey Details -->
                <div class="left-column">
                    <div class="journey-details">
                        <h3 class="section-title">INFORMASI PERJALANAN</h3>
                        <div class="info-grid">
                            <div class="info-row">
                                <div class="info-label">Kapal</div>
                                <div class="info-value">: {{ $tiket->jadwal->kapal->nama_kapal }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Tanggal</div>
                                <div class="info-value">: {{ \Carbon\Carbon::parse($tiket->jadwal->tanggal)->format('l, d F Y') }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Keberangkatan</div>
                                <div class="info-value">: {{ \Carbon\Carbon::parse($tiket->jadwal->waktu_berangkat)->format('H:i') }} WITA</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Estimasi Tiba</div>
                                <div class="info-value">: {{ \Carbon\Carbon::parse($tiket->jadwal->waktu_tiba)->format('H:i') }} WITA</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Penumpang</div>
                                <div class="info-value">: {{ $tiket->jumlah_penumpang }} orang</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Total Harga</div>
                                <div class="info-value">:Rp {{ number_format($tiket->total_harga, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - QR Code -->
                <div class="right-column">
                    <div class="qr-section">
                        <div class="qr-title">BOARDING PASS</div>
                        <img src="{{ $qrCodeImage }}" alt="QR Code" class="qr-code-img">
                        <div class="qr-instruction">
                            Tunjukkan QR Code ini<br>
                            saat proses boarding
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Notice -->
            <div class="important-notice">
                <h4 class="notice-title">🚨 PENTING - HARAP DIPERHATIKAN</h4>
                <ul class="notice-list">
                    <li><strong>Tiba di pelabuhan minimal 30 menit sebelum keberangkatan</strong></li>
                    <li><strong>Bawa dokumen identitas asli</strong> sesuai data pemesanan</li>
                    <li><strong>QR Code wajib ditunjukkan</strong> saat proses boarding</li>
                    <li>Simpan tiket ini hingga perjalanan selesai</li>
                </ul>
            </div>

            <!-- Passenger List -->
            <div class="passenger-section">
                <h3 class="section-title">DAFTAR PENUMPANG</h3>
                <table class="passenger-table">
                    <thead>
                        <tr>
                            <th style="width: 8%;">No</th>
                            <th style="width: 35%;">Nama Lengkap</th>
                            <th style="width: 25%;">No. Identitas</th>
                            <th style="width: 12%;">Usia</th>
                            <th style="width: 20%;">Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiket->penumpang as $index => $penumpang)
                            <tr>
                                <td style="text-align: center;">{{ $index + 1 }}</td>
                                <td>
                                    <span class="passenger-name">{{ $penumpang->nama_lengkap }}</span>
                                    @if($penumpang->is_pemesan)
                                        <span class="booker-badge">Pemesan</span>
                                    @endif
                                </td>
                                <td>{{ $penumpang->no_identitas }}</td>
                                <td style="text-align: center;">{{ $penumpang->usia }} th</td>
                                <td style="text-align: center;">{{ ucfirst($penumpang->jenis_kelamin) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="contact-info">
                📞 Customer Service: +62 361 123456 | ✉️ info@sanurboat.com
            </div>
            <div class="copyright">
                &copy; {{ date('Y') }} SanurBoat - Semua hak dilindungi undang-undang
            </div>
            <div class="validity-note">
                Dokumen ini dicetak pada {{ $today }} dan berlaku sebagai tiket resmi SanurBoat
            </div>
        </div>
    </div>
</body>
</html>
