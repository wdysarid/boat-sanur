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
        $metode = $this->faker->randomElement([
            'BCA', 'BRI', 'Mandiri', 'BNI', 'QRIS', 'DANA', 'OVO', 'Gopay'
        ]);

        return [
            'tiket_id' => Tiket::factory(),
            'metode_bayar' => $metode,
            'jumlah_bayar' => function(array $attributes) {
                return Tiket::find($attributes['tiket_id'])->total_harga;
            },
            'bukti_transfer' => null, // Kosongkan atau gunakan path default
            'status' => 'menunggu',
        ];
    }
}
