<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name' => 'Admin User',
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN',
        ]);

        User::factory()->count(200)->create();
        Product::factory()->count(200)->create();
    }
}
