<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::insert([
            [
                'name' => 'Admin Toko',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Kasir A',
                'email' => 'kasir1@example.com',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Kasir B',
                'email' => 'kasir2@example.com',
                'password' => Hash::make('password'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Petugas Gudang 1',
                'email' => 'gudang1@example.com',
                'password' => Hash::make('password'),
                'role' => 'gudang',
            ],
            [
                'name' => 'Petugas Gudang 2',
                'email' => 'gudang2@example.com',
                'password' => Hash::make('password'),
                'role' => 'gudang',
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@mail.com',
                'password' => Hash::make('password'),
                'role' => 'owner',
            ],
        ]);
    }
}
