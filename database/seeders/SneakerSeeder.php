<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SneakerSeeder extends Seeder
{
    public function run()
    {
        // Masukkan data dummy sepatu
        DB::table('sneakers')->insert([
            [
                'name' => 'Air Jordan 1 High OG',
                'brand_id' => 1,
                'size' => 42,
                'price' => 2500000.00, // Harga ada di sini!
                'stock' => 10,
                'description' => 'Sepatu legendaris michael jordan.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adidas Yeezy Boost 350',
                'brand' => 2,
                'size' => 40,
                'price' => 3500000.00,
                'stock' => 5,
                'description' => 'Sepatu nyaman rancangan Kanye West.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vans Old Skool',
                'brand' => 6,
                'size' => 39,
                'price' => 850000.00,
                'stock' => 20,
                'description' => 'Sepatu skate classic.',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
