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

      // siapkan paragraf untuk nanti dimasukkan sebagai HTML body
      $paragraphs = fake()->paragraphs(rand(5, 10)); // array
      $summary = fake()->text(120);

      // insert blog tanpa body dulu (body akan diupdate setelah image tersimpan)
      $blogId = DB::table('blogs')->insertGetId([
        'user_id' => $userId,
        'title' => $judul,
        'slug' => $slug,
        'summary' => $summary,
        'body' => '',
        'read_duration' => rand(3, 8),
        'view_count' => rand(100, 10000),
        'created_at' => now(),
        'updated_at' => now(),
      ]);

      // Variabel penampung path image
      $primaryPath = null;
      $nonPrimaryPaths = [];

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

            // simpan path untuk disisipkan ke body
            $nonPrimaryPaths[] = $nonPrimaryPath;
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

      // ==== BANGUN BODY HTML ====
      $bodyHtml = '';

      // Paragraf pertama (summary-like)
      if (!empty($paragraphs[0])) {
        $bodyHtml .= '<p>' . htmlspecialchars($paragraphs[0], ENT_QUOTES) . '</p>';
      }

      // sisip sisa paragraf, dan selipkan non-primary images di antara paragraf secara acak
      $remainingImages = $nonPrimaryPaths;
      $pCount = count($paragraphs);
      for ($pi = 1; $pi < $pCount; $pi++) {
        $bodyHtml .= '<p>' . htmlspecialchars($paragraphs[$pi], ENT_QUOTES) . '</p>';

        // kondisi penyisipan gambar: kalau ada gambar tersisa, sisip dengan probabilitas atau pada paragraf terakhir
        if (!empty($remainingImages)) {
          $shouldInsert = (rand(1, 100) <= 40) || ($pi === $pCount - 1); // 40% chance atau jika paragraf terakhir
          if ($shouldInsert) {
            $imgPath = array_shift($remainingImages);
            $bodyHtml .= '<figure><img src="/storage/' . $imgPath . '" alt="' . htmlspecialchars($judul, ENT_QUOTES) . '" style="max-width:100%;height:auto"></figure>';
          }
        }
      }

      // tambahkan subheading dan list sebagai variasi
      $bodyHtml .= '<h2>' . htmlspecialchars(fake()->sentence(rand(3,6)), ENT_QUOTES) . '</h2>';
      $bodyHtml .= '<ul>';
      $listItems = rand(2,4);
      for ($li = 0; $li < $listItems; $li++) {
        $bodyHtml .= '<li>' . htmlspecialchars(fake()->sentence(rand(4,8)), ENT_QUOTES) . '</li>';
      }
      $bodyHtml .= '</ul>';

      // akhir: tambahkan penutup
      $bodyHtml .= '<p><em>' . htmlspecialchars(fake()->sentence(rand(6,12)), ENT_QUOTES) . '</em></p>';

      // Update blog body dengan HTML yang sudah dibangun
      DB::table('blogs')->where('id', $blogId)->update([
        'body' => $bodyHtml,
        'updated_at' => now(),
      ]);
    }
  }
}
