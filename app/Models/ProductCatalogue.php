<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCatalogue extends Model
{
    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori', 'kategori');
    }
}
