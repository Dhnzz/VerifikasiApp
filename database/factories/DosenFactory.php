<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static ?string $user;

    public function definition(): array
    {
        return [
            // 'user_id' => UserFactory::new()->create(['role' => 'dosen'])->id,
            // 'name' => fake()->name(),
        ];
    }

    public function admin()
    {
        DosenFactory::new()->create([
            'user_id' => UserFactory::new()->create(['role' => 'admin'])->id,
            'name'=> fake()->name(),
        ]);
    }
    public function kajur()
    {
        DosenFactory::new()->create([
            'user_id' => UserFactory::new()->create(['role' => 'kajur'])->id,
            'name'=> fake()->name(),
        ]);
    }
}
