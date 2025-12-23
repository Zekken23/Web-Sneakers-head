<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // 1. Buat User Admin
    \App\Models\User::factory()->create([
        'name' => 'Super Admin',
        'email' => 'admin@sneakershead.co',
        'password' => bcrypt('password123'),
        'role' => 'admin', // <--- PENTING: Set role sebagai admin
    ]);

    // 2. Buat User Biasa (Contoh)
    \App\Models\User::factory()->create([
        'name' => 'Yusron User',
        'email' => 'user@gmail.com',
        'password' => bcrypt('password123'),
        'role' => 'user',
    ]);

    // Panggil seeder sepatu jika ada
    // $this->call(SneakerSeeder::class);
}
}
