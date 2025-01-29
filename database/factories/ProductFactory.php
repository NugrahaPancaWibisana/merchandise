<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_product' => $this->faker->randomElement([
                'Kaos Band',
                'Topi Baseball',
                'Gantungan Kunci Anime',
                'Mug Custom',
                'Stiker Vinyl',
                'Tas Tote',
                'Sweater Oversize',
                'Hoodie Zipper',
                'Pin Kecil',
                'Poster Limited Edition'
            ]),
            'harga_product' => $this->faker->randomNumber(6),
        ];
    }
}
