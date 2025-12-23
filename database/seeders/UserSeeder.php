<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Admin Zekken',
            'email' => 'Zekken766@gmaill.com', // Sesuai request
            'password' => Hash::make('zekken28'), // Password di-hash biar aman
            'role' => 'admin', // Role khusus admin
        ]);

        // 2. Buat Akun USER Biasa
        User::create([
            'name' => 'Muhammad Yusron',
            'email' => 'yusron@gmail.com', // Sesuai request
            'password' => Hash::make('yusron123'),
            'role' => 'user',
        ]);
    }
}
