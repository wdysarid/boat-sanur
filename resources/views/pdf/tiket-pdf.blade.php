<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>E-Tiket Fast Boat</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .ticket-container { border: 2px solid #333; padding: 20px; max-width: 800px; margin: 0 auto; }
        .ticket-header { background-color: #f8f9fa; padding: 10px; margin-bottom: 20px; }
        .ticket-body { display: flex; flex-wrap: wrap; gap: 20px; }
        .ticket-info { flex: 1; min-width: 300px; }
        .qr-code { flex: 0 0 200px; text-align: center; }
        .passenger-list { margin-top: 20px; }
        .footer { margin-top: 30px; font-size: 12px; text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-success { background-color: #d1fae5; color: #065f46; }
    </style>
</head>
<body>
    <div class="header">
        <h1>E-Tiket Fast Boat</h1>
        <p>Tanggal Cetak: {{ $today }}</p>
    </div>

    <div class="ticket-container">
        <div class="ticket-header">
            <h2>{{ $tiket->jadwal->rute_asal }} → {{ $tiket->jadwal->rute_tujuan }}</h2>
            <p>Kode Pemesanan: <strong>{{ $tiket->kode_pemesanan }}</strong></p>
        </div>

        <div class="ticket-body">
            <div class="ticket-info">
                <h3>Informasi Perjalanan</h3>
                <p><strong>Kapal:</strong> {{ $tiket->jadwal->kapal->nama_kapal }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($tiket->jadwal->tanggal)->format('d F Y') }}</p>
                <p><strong>Waktu:</strong> {{ $tiket->jadwal->waktu_berangkat }} - {{ $tiket->jadwal->waktu_tiba }}</p>
                <p><strong>Status:</strong>
                    <span class="status-badge badge-success">Dikonfirmasi</span>
                </p>

                <div class="passenger-list">
                    <h3>Daftar Penumpang ({{ $tiket->jumlah_penumpang }} orang)</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>No. Identitas</th>
                                <th>Usia</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tiket->penumpang as $penumpang)
                            <tr>
                                <td>{{ $penumpang->nama_lengkap }}</td>
                                <td>{{ $penumpang->no_identitas }}</td>
                                <td>{{ $penumpang->usia }} tahun</td>
                                <td>{{ ucfirst($penumpang->jenis_kelamin) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="qr-code">
                <img src="{{ $qrCodeImage }}" alt="QR Code Tiket" width="200" height="200">
                <p>Scan QR Code ini saat boarding</p>
            </div>
        </div>

        <div class="footer">
            <p>Harap tiba di pelabuhan minimal 30 menit sebelum keberangkatan</p>
            <p>&copy; {{ date('Y') }} Tiket Boat Sanur</p>
        </div>
    </div>
</body>
</html>
