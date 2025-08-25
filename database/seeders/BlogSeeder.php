<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $kategoriMaster = DB::table('blog_categories_master')->pluck('id', 'name')->toArray();

        // Buat 30 blog dengan judul dan body acak
        for ($i = 0; $i < 30; $i++) {
            $judul = fake()->sentence(rand(4, 8));
            $slug = Str::slug($judul);
            $userId = fake()->randomElement($userIds);

            $blogId = DB::table('blogs')->insertGetId([
                'user_id' => $userId,
                'title' => $judul,
                'slug' => $slug,
                'summary' => fake()->text(120),
                'body' => fake()->paragraphs(rand(5, 10), true),
                'read_duration' => rand(3, 8),
                'view_count' => rand(100, 10000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Download dan simpan gambar utama ke storage public
            $primaryUrl = "https://picsum.photos/seed/{$slug}-primary/1200/600";
            $primaryContents = file_get_contents($primaryUrl);
            $primaryExt = 'jpg';
            $primaryPath = "blogs/{$blogId}/primary/{$slug}.{$primaryExt}";
            Storage::disk('public')->put($primaryPath, $primaryContents);

            DB::table('blog_images')->insert([
                'blog_id' => $blogId,
                'is_primary' => true,
                'image' => $primaryPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Download dan simpan 1-2 gambar non-primary ke storage public
            $jumlahNonPrimary = rand(1, 2);
            for ($j = 1; $j <= $jumlahNonPrimary; $j++) {
                $nonPrimaryUrl = "https://picsum.photos/seed/{$slug}-{$j}/800/600";
                $nonPrimaryContents = file_get_contents($nonPrimaryUrl);
                $nonPrimaryExt = 'jpg';
                $nonPrimaryPath = "blogs/{$blogId}/{$slug}-{$j}.{$nonPrimaryExt}";
                Storage::disk('public')->put($nonPrimaryPath, $nonPrimaryContents);
                DB::table('blog_images')->insert([
                    'blog_id' => $blogId,
                    'is_primary' => false,
                    'image' => $nonPrimaryPath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Kategori: 1-3 kategori acak
            $kategoriIds = array_values($kategoriMaster);
            shuffle($kategoriIds);
            $jumlahKategori = rand(1, 3);
            foreach (array_slice($kategoriIds, 0, $jumlahKategori) as $kategoriId) {
                DB::table('blog_categories')->insert([
                    'blog_id' => $blogId,
                    'blog_category_master_id' => $kategoriId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
