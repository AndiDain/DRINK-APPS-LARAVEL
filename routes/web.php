<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view("/", "dashboard")->name("dashboard");
Route::get("/product", [ProdukController::class, 'show'])->name("product");
Route::get("/detail/{detail}", [ProdukController::class, 'showDetail'])->name("detail-product");
Route::view("/contact", "contact")->name("contact");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
});

require __DIR__.'/auth.php';
