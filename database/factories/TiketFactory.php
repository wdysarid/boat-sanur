<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Jadwal;
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
        $jadwal = Jadwal::factory()->create();

        return [
            'user_id' => User::factory(),
            'jadwal_id' => $jadwal->id,
            'kode_pemesanan' => strtoupper($this->faker->bothify('??##??##')),
            'jumlah_penumpang' => $jumlah,
            'total_harga' => $jadwal->harga_tiket * $jumlah,
            'status' => 'menunggu',
        ];
    }
}
