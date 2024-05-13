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
        return [
            'user_id' => UserFactory::new()->create(['role' => 'mahasiswa'])->id,
            'dosen_id' => DosenFactory::new()->create()->id,
            'name' => fake()->name(),
            'nim' => fake()->unique()->randomNumber(9),
            'batch' => fake()->randomNumber(4),
        ];
    }
}