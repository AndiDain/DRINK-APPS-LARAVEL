<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->decimal('harga', 8, 2);
            $table->string('gambar')->nullable();
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
        });

        Schema::create('ulasan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->string('nama_reviewer');
            $table->unsignedTinyInteger('rating');
            $table->text('komentar');
        });

        Schema::create('pesan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->text('pesan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
