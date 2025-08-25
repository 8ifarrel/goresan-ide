<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategoriesMasterSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            'Teknologi', 'Sains', 'Bisnis', 'Gaya Hidup', 'Budaya', 'Kesehatan'
        ];

        foreach ($kategori as $nama) {
            DB::table('blog_categories_master')->insert([
                'name' => $nama,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
