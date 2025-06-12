<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kapal>
 */
class KapalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shipNames = [
            'Bali Sea', 'Nusa Indah', 'Ocean Star', 'Island Hopper', 'Sea Explorer',
            'Blue Wave', 'Sunset Cruiser', 'Pearl Voyager', 'Coral Princess', 'Island Dream'
        ];

        return [
            'id' => 'BT' . str_pad($this->faker->unique()->numberBetween(1, 99), 3, '0', STR_PAD_LEFT),
            'nama_kapal' => $this->faker->randomElement($shipNames),
            'kapasitas' => $this->faker->numberBetween(50, 100),
            'deskripsi' => $this->faker->sentence(10),
            'foto_kapal' => null, // Kosongkan saja atau bisa diisi dengan path default
            'status' => $this->faker->randomElement(['aktif', 'maintenance', 'tidak aktif']),
        ];
        }
}
