<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $products = [
            // Kategori Pakaian
            [
                'nama_product' => 'T-Shirt Logo',
                'harga_product' => 120000,
                'category_id' => 1,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Hoodie Premium',
                'harga_product' => 285000,
                'category_id' => 1,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Polo Shirt',
                'harga_product' => 175000,
                'category_id' => 1,
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori Aksesoris
            [
                'nama_product' => 'Pin Badge',
                'harga_product' => 15000,
                'category_id' => 2,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Lanyard Premium',
                'harga_product' => 45000,
                'category_id' => 2,
                'stock' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Gantungan Kunci',
                'harga_product' => 25000,
                'category_id' => 2,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori Tas & Dompet
            [
                'nama_product' => 'Tote Bag Canvas',
                'harga_product' => 95000,
                'category_id' => 3,
                'stock' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Backpack',
                'harga_product' => 245000,
                'category_id' => 3,
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Dompet Card Holder',
                'harga_product' => 75000,
                'category_id' => 3,
                'stock' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori Stationary
            [
                'nama_product' => 'Notebook Premium',
                'harga_product' => 65000,
                'category_id' => 4,
                'stock' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Pen Set',
                'harga_product' => 85000,
                'category_id' => 4,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Sticker Pack',
                'harga_product' => 12000,
                'category_id' => 4,
                'stock' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kategori Gelas & Botol
            [
                'nama_product' => 'Tumbler Stainless',
                'harga_product' => 185000,
                'category_id' => 5,
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Mug Ceramic',
                'harga_product' => 75000,
                'category_id' => 5,
                'stock' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_product' => 'Glass Cup',
                'harga_product' => 65000,
                'category_id' => 5,
                'stock' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Product::insert($products);
    }
}
