<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'pesan' => $this->faker->sentence(10),
            'rating' => $this->faker->numberBetween(1, 5),
            'disetujui' => $this->faker->boolean(30), // 30% kemungkinan disetujui
        ];
    }
}
