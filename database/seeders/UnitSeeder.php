<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        Unit::insert([
            ['name' => 'PCS'],
            ['name' => 'PACK'],
            ['name' => 'KARTON'],
            ['name' => 'BOTOL'],
            ['name' => 'SACHET'],
            ['name' => 'REFF'],
            ['name' => 'DUS'],
            ['name' => 'KG'],
            ['name' => 'LITER'],
            ['name' => 'BUNGKUS'],
        ]);
    }
}
