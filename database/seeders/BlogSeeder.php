<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Arr;
use Exception;

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
      $userId = Arr::random($userIds);

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

      // ==== PRIMARY IMAGE ====
      try {
        $primaryUrl = "https://picsum.photos/seed/{$slug}-primary/1200/600";
        $response = Http::withOptions(['verify' => false, 'timeout' => 30])->get($primaryUrl);

        if ($response->successful()) {
          $primaryContents = $response->body();
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
        }
        // Tambahkan delay setelah request ke picsum
        usleep(300000); // 0.3 detik
      } catch (Exception $e) {
        // fallback kalau gagal download
        logger()->warning("Gagal download primary image untuk slug {$slug}: " . $e->getMessage());
      }

      // ==== NON PRIMARY IMAGE ====
      $jumlahNonPrimary = rand(1, 2);
      for ($j = 1; $j <= $jumlahNonPrimary; $j++) {
        try {
          $nonPrimaryUrl = "https://picsum.photos/seed/{$slug}-{$j}/800/600";
          $response = Http::withOptions(['verify' => false, 'timeout' => 30])->get($nonPrimaryUrl);

          if ($response->successful()) {
            $nonPrimaryContents = $response->body();
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
          // Tambahkan delay setelah request ke picsum
          usleep(300000); // 0.3 detik
        } catch (Exception $e) {
          logger()->warning("Gagal download non-primary image untuk slug {$slug}: " . $e->getMessage());
        }
      }

      // ==== KATEGORI ====
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
