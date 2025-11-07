<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produk;

class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Produk::class;
    public function definition(): array
    {
        $drinks = [
            'Es Teh Manis',
            'Es Kopi Susu',
            'Matcha Latte',
            'Boba Milk Tea',
            'Americano',
            'Cappuccino',
            'Thai Tea',
            'Lemon Tea',
            'Orange Juice',
            'Strawberry Smoothie'
        ];

        $categories = ['Coffee', 'Tea', 'Juice', 'Milk-based', 'Smoothie'];

        return [
            'nama_produk' => $this->faker->unique()->randomElement($drinks),
            'kategori' => $this->faker->randomElement($categories),
            'deskripsi' => $this->faker->paragraph(2),
            'harga' => $this->faker->numberBetween(15000, 45000),
            'gambar' => 'drinks/' . $this->faker->numberBetween(1, 10) . '.jpg',
        ];
    }
}
