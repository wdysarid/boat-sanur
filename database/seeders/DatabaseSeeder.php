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

        // $user = User::factory(1)->create();

        // $kapal = Kapal::factory(3)->create();

        // $jadwal = Jadwal::factory(10)->make()->each(function ($jadwal) use ($kapal) {
        //     $jadwal->kapal_id = $kapal->random()->id;
        //     $jadwal->save();
        // });

        // $tiket = Tiket::factory(10)->make()->each(function ($tiket) use ($user, $jadwal) {
        //     $tiket->user_id = $user->random()->id;
        //     $tiket->jadwal_id = $jadwal->random()->id;
        //     $tiket->save();
        // });

        // $validTiket = $tiket->where('status', 'menunggu');
        // Pembayaran::factory(5)->make()->each(function ($pembayaran) use ($validTiket) {
        //     $tiket = $validTiket->random();
        //     $pembayaran->tiket_id = $tiket->id;
        //     $pembayaran->save();
        // });

        // Feedback::factory(10)->make()->each(function ($feedback) use ($user) {
        //     $feedback->user_id = $user->random()->id;
        //     $feedback->save();
        // });
    }
}
