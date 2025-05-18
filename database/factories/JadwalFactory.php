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
        $kota = ['Denpasar', 'Lombok', 'Surabaya', 'Makassar', 'Labuan Bajo', 'Bali', 'Padang']; // bisa ubah lagi nanti lebih realistis listnya
        $asal = $this->faker->randomElement($kota);
        $tujuan = $this->faker->randomElement(array_diff($kota, [$asal]));

        $waktuBerangkat = $this->faker->dateTimeBetween('+1 day', '+5 days');
        return [
            'kapal_id' => Kapal::factory(),
            'rute' => "$asal - $tujuan",
            'waktu_berangkat' => $waktuBerangkat,
            'waktu_tiba' => (clone $waktuBerangkat)->modify('+'. rand(1, 3) .' hours'),
            'harga_tiket' => $this->faker->numberBetween(100000, 300000),
            'kuota' => $this->faker->numberBetween(50, 200),
        ];
    }
}
