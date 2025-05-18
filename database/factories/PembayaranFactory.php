<?php

namespace Database\Factories;

use App\Models\Tiket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tiket = Tiket::factory()->create();
        return [
            'tiket_id' => $tiket->id,
            'metode_bayar' => $this->faker->randomElement(['Transfer Bank', 'QRIS', 'E-Wallet']),
            'jumlah_bayar' => $tiket->total_harga,
            'bukti_transfer' => 'uploads/bukti/' . $this->faker->uuid() . '.jpg',
            'status' => 'menunggu',
        ];
    }
}
