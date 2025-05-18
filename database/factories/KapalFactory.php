<?php

namespace Database\Factories;

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
            'nama_kapal' => $this->faker->company() . ' Express',
            'kapasitas' => $this->faker->numberBetween(50, 200),
            'deskripsi' => fake()->sentence(6),
        ];
    }
}
