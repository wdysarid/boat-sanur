<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kapal;
use App\Models\Jadwal;
use App\Models\Tiket;
use App\Models\Pembayaran;
use App\Models\Feedback;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'password' => 'admin123', 
            'role' => 'admin',
        ]);

        $users = User::factory(5)->create();

        $kapals = Kapal::factory(3)->create();

        $jadwals = Jadwal::factory(10)->make()->each(function ($jadwal) use ($kapals) {
            $jadwal->kapal_id = $kapals->random()->id;
            $jadwal->save();
        });

        $tikets = Tiket::factory(10)->make()->each(function ($tiket) use ($users, $jadwals) {
            $tiket->user_id = $users->random()->id;
            $tiket->jadwal_id = $jadwals->random()->id;
            $tiket->save();
        });

        $validTikets = $tikets->where('status', 'menunggu');
        Pembayaran::factory(5)->make()->each(function ($pembayaran) use ($validTikets) {
            $tiket = $validTikets->random();
            $pembayaran->tiket_id = $tiket->id;
            $pembayaran->save();
        });

        Feedback::factory(10)->make()->each(function ($feedback) use ($users) {
            $feedback->user_id = $users->random()->id;
            $feedback->save();
        });
    }
}
