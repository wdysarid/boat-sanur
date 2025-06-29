<?php

namespace Database\Factories;

use App\Models\Tiket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penumpang>
 */
class PenumpangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'no_identitas' => $this->faker->numerify('############'), // 12 digit random
            'usia' => $this->faker->numberBetween(5, 70),
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'is_pemesan' => false, // Default false, akan diupdate di seeder
            'status' => 'booked',
            'checked_in_at' => null,
        ];
    }

    public function pemesan(User $user)
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'is_pemesan' => true,
                'user_id' => $user->id,
                'nama_lengkap' => $user->nama,
                'usia' => $this->faker->numberBetween(18, 60),
            ];
        });
    }

    public function checkedIn()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'checked_in',
                'checked_in_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            ];
        });
    }
}
