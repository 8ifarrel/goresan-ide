<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
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
        try {
            $mainAvatarResponse = Http::withOptions(['verify' => false, 'timeout' => 10])->get($mainAvatarUrl);
            if ($mainAvatarResponse->successful()) {
                $mainAvatarContents = $mainAvatarResponse->body();
                $mainAvatarExt = 'jpg';
                $mainAvatarPath = "users/{$user->id}/profile-picture/{$user->id}.{$mainAvatarExt}";
                Storage::disk('public')->put($mainAvatarPath, $mainAvatarContents);
                $user->profile_picture = $mainAvatarPath;
                $user->save();
            }
        } catch (\Exception $e) {
            logger()->warning("Gagal download avatar utama untuk {$mainEmail}: " . $e->getMessage());
        }
        usleep(300000); // delay 0.3 detik setelah ambil gambar

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
            try {
                $avatarResponse = Http::withOptions(['verify' => false, 'timeout' => 10])->get($avatarUrl);
                if ($avatarResponse->successful()) {
                    $avatarContents = $avatarResponse->body();
                    $avatarExt = 'jpg';
                    $avatarPath = "users/{$newUser->id}/profile-picture/{$newUser->id}.{$avatarExt}";
                    Storage::disk('public')->put($avatarPath, $avatarContents);
                    $newUser->profile_picture = $avatarPath;
                    $newUser->save();
                }
            } catch (\Exception $e) {
                logger()->warning("Gagal download avatar untuk {$email}: " . $e->getMessage());
            }
            usleep(300000); // delay 0.3 detik setelah ambil gambar
        }
    }
}
