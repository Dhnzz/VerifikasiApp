<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = UserFactory::new()->create(['role' => 'mahasiswa']);
        return [
            'user_id' => $user->id,
            'dosen_id' => DosenFactory::new()->create()->id,
            'name' => fake()->name(),
            'angkatan' => fake()->randomNumber(4),
        ];
    }
}
