<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        // User utama
        $mainName = 'Farrel Sirah';
        $mainUsername = '8ifarrel';
        $mainEmail = 'farrelsirah@example.com';

        $user = User::factory()->create([
            'fullname' => $mainName,
            'username' => $mainUsername,
            'email' => $mainEmail,
            'password' => Hash::make('password'),
            'is_admin' => true,
            'about' => fake('id_ID')->sentence(10),
        ]);

        // Ambil dan simpan foto profil utama
        $mainAvatarUrl = 'https://i.pravatar.cc/300?u=' . urlencode($mainEmail);
        $mainAvatarContents = file_get_contents($mainAvatarUrl);
        $mainAvatarExt = 'jpg';
        $mainAvatarPath = "users/{$user->id}/profile-picture/{$user->id}.{$mainAvatarExt}";
        Storage::disk('public')->put($mainAvatarPath, $mainAvatarContents);
        $user->profile_picture = $mainAvatarPath;
        $user->save();

        // 9 user lain dengan identitas unik
        for ($i = 1; $i <= 9; $i++) {
            $fake = fake('id_ID');
            $fake_name = $fake->name;
            $username = Str::slug($fake_name) . $i;
            $email = $fake->unique()->safeEmail;

            $newUser = User::factory()->create([
                'fullname' => $fake_name,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make('password'),
                'is_admin' => false,
                'about' => $fake->sentence(rand(7, 10)),
            ]);

            // Ambil dan simpan foto profil
            $avatarUrl = 'https://i.pravatar.cc/300?u=' . urlencode($email);
            $avatarContents = file_get_contents($avatarUrl);
            $avatarExt = 'jpg';
            $avatarPath = "users/{$newUser->id}/profile-picture/{$newUser->id}.{$avatarExt}";
            Storage::disk('public')->put($avatarPath, $avatarContents);
            $newUser->profile_picture = $avatarPath;
            $newUser->save();
        }
    }
}
