<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    public $timestamps = false;

    protected $fillable = [
        'nama_produk',
        'kategori',
        'deskripsi',
        'harga',
        'gambar'
    ];

    public function productCatalogue()
    {
        return $this->belongsTo(ProductCatalogue::class, 'kategori', 'kategori');
    }
}
