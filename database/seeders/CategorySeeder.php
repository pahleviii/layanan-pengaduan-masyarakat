<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $categories = [
        ['name' => 'Jalan Rusak', 'slug' => 'jalan-rusak'],
        ['name' => 'Kebersihan', 'slug' => 'kebersihan'],
        ['name' => 'Lampu Jalan', 'slug' => 'lampu-jalan'],
        ['name' => 'Saluran Air', 'slug' => 'saluran-air'],
        ['name' => 'Fasilitas Umum', 'slug' => 'fasilitas-umum'],
        ['name' => 'Lainnya', 'slug' => 'lainnya'],
    ];

    foreach ($categories as $category) {
        \App\Models\Category::create($category);
    }
}

}
