<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function show(){
        $produk = Produk::all();
        return view("product",compact("produk"));
    }

    public function showdetail(){
        $produk = Produk::all();
        return view("detail-product",compact("produk"));
    }

    



    // public function search(Request $request)
    // {
    //     $query = Produk::query();

    //     // cari melalui nama atau kategori
    //     if ($search = $request->query('search')) {
    //         $query->where(function ($q) use ($search) {
    //             $q->where('nama_produk', 'like', "%{$search}%")
    //                 ->orWhere('deskripsi', 'like', "%{$search}%");
    //         });
    //     }

    //     if ($kategori = $request->query('kategori')) {
    //         $query->where('kategori', $kategori);
    //     }

    //     $produk = $query->orderBy('id','desc')->paginate(9)->withQueryString();

    //     $categories = Produk::select('kategori')->distinct()->pluck('kategori');

    //     return view('product', compact('produk', 'categories'));

    // }
}
