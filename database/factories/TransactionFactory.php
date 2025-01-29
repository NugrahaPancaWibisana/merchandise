<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'id_produk' => Product::inRandomOrder()->first()->id,
            'nama_pelanggan' => $this->faker->name,
            'nomor_unik' => $this->faker->unique()->numerify('########'),
            'uang_bayar' => function (array $attributes) {
                $product = Product::find($attributes['id_produk']);
                return $product->harga_product + $this->faker->numberBetween(1000, 100000);
            },
            'uang_kembali' => function (array $attributes) {
                $product = Product::find($attributes['id_produk']);
                return $attributes['uang_bayar'] - $product->harga_product;
            },
            'created_at' => $this->faker->dateTimeBetween('-1 years', '+1 days'),
        ];
    }
}
