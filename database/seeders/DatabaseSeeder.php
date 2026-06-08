<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    \App\Models\User::create([
        'name' => 'asep',
        'email' => 'asep@gmail.com',
        'password' => bcrypt('password123'),
    ]);

    \App\Models\Kategori::create(['nama_kategori' => 'Novel']);
    \App\Models\Kategori::create(['nama_kategori' => 'Biografi']);
    \App\Models\Kategori::create(['nama_kategori' => 'Komik']);
}
}
