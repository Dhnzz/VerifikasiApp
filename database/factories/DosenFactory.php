<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
            'user_id' => UserFactory::new()->create([
                'credential' => 'admin',
                'password' => 'admin',
                'role' => 'admin'
            ]),
            'name'=> fake()->name(),
        ]);
    }
    public function kajur()
    {
        $credential = fake()->unique()->numerify('##########');
        $password = Hash::make($credential);
        DosenFactory::new()->create([
            'user_id' => UserFactory::new()->create([
                'credential' => $credential,
                'password' => $password,
                'role' => 'kajur'
            ]),
            'name'=> fake()->name(),
        ]);
    }
}
