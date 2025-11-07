<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 6 random drinks
        Produk::factory()->count(5)->create();

        // Create specific drinks with custom data
        Produk::create([
            'nama_produk' => 'Signature Coffee',
            'kategori' => 'Coffee',
            'deskripsi' => 'Our signature house blend coffee, perfectly roasted and brewed to perfection.',
            'harga' => 25000,
            'gambar' => 'drinks/signature.jpg'
        ]);
    }
}
