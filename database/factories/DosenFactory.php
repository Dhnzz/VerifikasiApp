<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;

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
        $dosen = Role::factory()->create(['name' => 'dosen']);
        return [
            'user_id' =>  UserFactory::new()->create(['role_id' => $dosen->id])->id,
            'name' => fake()->name(),
        ];
    }

    public function superAdmin()
    {
        return $this->state(function (array $attributes) {
            $admin = Role::factory()->create(['name' => 'super_admin']);
            return [
                'user_id' =>  UserFactory::new()->create(['role_id' => $admin->id])->id,
            ];
        });
    }
}
