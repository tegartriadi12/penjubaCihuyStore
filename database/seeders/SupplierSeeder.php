<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [];

        for ($i = 1; $i <= 20; $i++) {
            $suppliers[] = [
                'name' => "Supplier $i",
                'phone' => '08' . rand(100000000, 999999999),
                'address' => "Alamat Supplier No.$i",
            ];
        }

        Supplier::insert($suppliers);
    }
}
