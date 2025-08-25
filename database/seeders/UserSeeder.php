<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        // User utama
        User::factory()->create([
            'name' => 'Farrel Sirah',
            'email' => 'farrelsirah@example.com',
            'password' => Hash::make('password'),
        ]);

        // 9 user lain dengan identitas unik
        for ($i = 1; $i <= 9; $i++) {
            User::factory()->create([
                'name' => fake()->name,
                'email' => fake()->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
        }
    }
}
