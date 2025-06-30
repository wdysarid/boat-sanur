<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tiket>
 */
class TiketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jumlah = $this->faker->numberBetween(1, 5);

        // Format kode pemesanan: TKT + tanggal (ddmmyy) + random 4 digit
        $kode = 'TKT-' . now()->format('dmy') . strtoupper(Str::random(7));

        return [
            'user_id' => User::factory(),
            'jadwal_id' => function () {
                // Jika sudah ada jadwal di database, gunakan random dari yang ada
                if (Jadwal::count() > 0) {
                    return Jadwal::inRandomOrder()->first()->id;
                }
                // Jika belum ada, buat baru
                return Jadwal::factory()->create()->id;
            },
            'kode_pemesanan' => $kode,
            'jumlah_penumpang' => $jumlah,
            'total_harga' => function (array $attributes) {
                return Jadwal::find($attributes['jadwal_id'])->harga_tiket * $attributes['jumlah_penumpang'];
            },
            'status' => 'sukses',
        ];
    }
}
