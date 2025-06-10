<?php

namespace Database\Factories;

use App\Models\Kapal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jadwal>
 */
class JadwalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lokasi = ['Sanur', 'Nusa Penida', 'Nusa Lembongan', 'Nusa Ceningan', 'Gili Trawangan'];

        // Pilih asal dan tujuan yang berbeda
        $asal = $this->faker->randomElement($lokasi);
        $tujuan = $this->faker->randomElement(array_diff($lokasi, [$asal]));

        $waktuBerangkat = $this->faker->dateTimeBetween('+1 day', '+30 days');
        $waktuTiba = (clone $waktuBerangkat)->modify('+'.rand(1, 3).' hours');

        return [
            'kapal_id' => Kapal::factory(),
            'rute_asal' => $asal,
            'rute_tujuan' => $tujuan,
            'tanggal' => $waktuBerangkat->format('Y-m-d'),
            'waktu_berangkat' => $waktuBerangkat,
            'waktu_tiba' => $waktuTiba,
            'harga_tiket' => $this->faker->numberBetween(10000, 500000),
            'keterangan' => $this->faker->optional(0.3)->sentence(), // 30% chance memiliki keterangan
            'status' => $this->faker->randomElement(['aktif', 'selesai']),
        ];
    }
}
