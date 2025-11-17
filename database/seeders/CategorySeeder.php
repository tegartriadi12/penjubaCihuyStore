<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Sembako'],
            ['name' => 'Bumbu Dapur'],
            ['name' => 'Minuman'],
            ['name' => 'Kopi & Teh'],
            ['name' => 'Makanan Ringan'],
            ['name' => 'Rokok'],
            ['name' => 'Mie Instan'],
            ['name' => 'Kecap & Saus'],
            ['name' => 'Kue Kering'],
            ['name' => 'Peralatan Mandi'],
            ['name' => 'Peralatan Cuci'],
            ['name' => 'Obat & Vitamin'],
            ['name' => 'Gas & Air'],
            ['name' => 'Alat Rumah Tangga'],
            ['name' => 'Susu & Produk Dairy'],
        ]);
    }
}
