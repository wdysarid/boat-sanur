<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kapal;
use App\Models\Tiket;
use App\Models\Jadwal;
use App\Models\Feedback;
use App\Models\Pembayaran;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'no_telp' => '081234567890',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            // 'remember_token' => Str::random(100),
        ]);

        // Akun user
        User::create([
            'nama' => 'Sunny',
            'email' => 'sunny@gmail.com',
            'no_telp' => '081234567891',
            'password' => Hash::make('sunny123'),
            'role' => 'wisatawan',
            // 'remember_token' => Str::random(100),
        ]);

                // Akun user
        User::create([
            'nama' => 'Widyasari Damayanti',
            'email' => 'widyasaridamayanti@gmail.com',
            'no_telp' => '081238267420',
            'password' => Hash::make('wdy123'),
            'role' => 'wisatawan',
            // 'remember_token' => Str::random(100),
        ]);

        // Buat 10 user wisatawan
        $users = User::factory(10)->create();

        // Buat kapal
        $kapals = new Collection();

        // 5 kapal aktif
        $kapals = $kapals->merge(Kapal::factory(5)->create(['status' => 'aktif']));

        // 2 kapal maintenance
        $kapals = $kapals->merge(Kapal::factory(2)->create(['status' => 'maintenance']));

        // 1 kapal tidak aktif
        $kapals = $kapals->merge(Kapal::factory(1)->create(['status' => 'tidak aktif']));

        // Buat 15 jadwal (10 aktif + 5 selesai)
        $jadwals = new Collection();

        // 20 jadwal aktif
        for ($i = 0; $i < 10; $i++) {
            $jadwals->push(
                Jadwal::factory()->create([
                    'kapal_id' => $kapals->where('status', 'aktif')->random()->id,
                    'status' => 'aktif',
                ]),
            );
        }

        // 5 jadwal selesai
        for ($i = 0; $i < 5; $i++) {
            $jadwals->push(
                Jadwal::factory()->create([
                    'kapal_id' => $kapals->where('status', 'aktif')->random()->id,
                    'status' => 'selesai',
                    'tanggal' => now()->subDays(rand(1, 30))->format('Y-m-d'),
                ]),
            );
        }

        // Buat 30 tiket menggunakan jadwal yang sudah ada
        $tikets = new Collection();
        for ($i = 0; $i < 300; $i++) {
            $jadwal = $jadwals->random();
            $kapal = $kapals->find($jadwal->kapal_id);
            $tiketTerjual = $jadwal->tiket()->where('status', 'sukses')->sum('jumlah_penumpang');
            $kapasitasTersedia = $kapal->kapasitas - $tiketTerjual;

            if ($kapasitasTersedia <= 0) {
                continue;
            }

            $jumlahPenumpang = rand(1, min(10, $kapasitasTersedia)); // Maksimal 10 penumpang per tiket

            $tikets->push(
                Tiket::factory()->create([
                    'user_id' => $users->random()->id,
                    'jadwal_id' => $jadwal->id,
                    'jumlah_penumpang' => $jumlahPenumpang,
                ]),
            );
        }

        // Update status tiket
        $statuses = ['sukses', 'dibatalkan'];
        foreach ($tikets->random(15) as $tiket) {
            $tiket->update([
                'status' => $statuses[array_rand($statuses)],
            ]);
        }

        // Buat pembayaran
        foreach ($tikets as $tiket) {
            if (in_array($tiket->status, ['menunggu', 'sukses'])) {
                Pembayaran::create([
                    'tiket_id' => $tiket->id,
                    'metode_bayar' => ['BCA', 'BRI', 'Mandiri', 'BNI', 'QRIS', 'DANA', 'OVO', 'Gopay'][array_rand([0, 1, 2, 3, 4, 5, 6, 7])],
                    'jumlah_bayar' => $tiket->total_harga,
                    'bukti_transfer' => null,
                    'status' => $tiket->status === 'sukses' ? 'terverifikasi' : 'menunggu',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Buat feedback
        $completedTripUsers = $tikets->where('status', 'sukses')->pluck('user_id')->unique();

        foreach ($completedTripUsers as $userId) {
            Feedback::create([
                'user_id' => $userId,
                'pesan' => 'Pelayanan sangat memuaskan, kapal nyaman dan tepat waktu.',
                'rating' => rand(4, 5), // Rating tinggi untuk pengalaman positif
                'status' => rand(0, 1) ? 'disetujui' : 'pending', // 50% disetujui, 50% pending
            ]);
        }

        // Tambahkan beberapa feedback ditolak
        Feedback::create([
            'user_id' => $users->random()->id,
            'pesan' => 'Kapal sangat terlambat dan tidak nyaman.',
            'rating' => 1,
            'status' => 'ditolak',
        ]);

        Feedback::create([
            'user_id' => $users->random()->id,
            'pesan' => 'Pelayanan buruk, kru tidak ramah.',
            'rating' => 2,
            'status' => 'ditolak',
        ]);
    }
}
