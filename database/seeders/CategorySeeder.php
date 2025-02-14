<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pakaian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aksesoris',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tas & Dompet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Stationary',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gelas & Botol',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Category::insert($categories);
    }
}
