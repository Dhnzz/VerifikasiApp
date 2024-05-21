<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Dosen::factory(5)->create();
        Mahasiswa::factory(5)->create();


        // $user = User::create([
        //     'credential' => fake()->unique()->numerify('##########'),
        //     'password' => Hash::make('1sampai9'),
        //     'role' => 'super_admin'
        // ]);
        // Dosen::create([
        //     'name' => "Super Admin",
        //     'user_id' => $user->id
        // ]);
        Dosen::factory(1)->superAdmin()->create();
    }
}
