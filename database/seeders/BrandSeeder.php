<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = ['Nike', 'Adidas', 'Puma', 'Asics', 'New Balance', 'Vans', 'Converse', 'Reebok'];

        foreach ($brands as $name) {
            Brand::create(['name' => $name]);
        }
    }
}
