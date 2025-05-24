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
        return [
            'id' => Str::upper(Str::random(2)) . str_pad($this->faker->unique()->numberBetween(1, 99), 3, '0', STR_PAD_LEFT),
            'nama_kapal' => $this->faker->company() . ' Express',
            'kapasitas' => $this->faker->numberBetween(50, 100),
            'deskripsi' => fake()->sentence(6),
            'foto_kapal' => $this->faker->optional()->imageUrl(640, 480, 'ship'), // 50% chance menghasilkan URL gambar
            'status' => $this->faker->randomElement(['aktif', 'maintenance', 'tidak aktif']),
        ];
    }
}
