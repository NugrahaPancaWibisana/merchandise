<?php

namespace Database\Seeders;

use App\Models\User;
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
            'status' => 'ACTIVE',
        ]);

        User::create([
            'username' => 'owner',
            'name' => 'Owner User',
            'password' => Hash::make('owner123'),
            'role' => 'OWNER',
            'status' => 'ACTIVE',
        ]);

        User::create([
            'username' => 'kasir',
            'name' => 'Kasir User',
            'password' => Hash::make('kasir123'),
            'role' => 'KASIR',
            'status' => 'ACTIVE',
        ]);

        User::factory()->count(200)->create();

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
