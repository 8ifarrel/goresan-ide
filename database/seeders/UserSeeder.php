<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        // User utama
        User::factory()->create([
            'fullname' => 'Farrel Sirah',
            'username' => '8ifarrel',
            'email' => 'farrelsirah@example.com',
            'password' => Hash::make('password'),
            'is_superadmin' => true,
            'about' => fake()->sentence(10),
        ]);

        // 9 user lain dengan identitas unik
        for ($i = 1; $i <= 9; $i++) {
            $fake_name = fake()->name;
            User::factory()->create([
                'fullname' => $fake_name,
                'username' => Str::slug($fake_name),
                'email' => fake()->unique()->safeEmail,
                'password' => Hash::make('password'),
                'is_superadmin' => false,
                'about' => fake()->sentence(rand(7, 10)),

            ]);
        }
    }
}
