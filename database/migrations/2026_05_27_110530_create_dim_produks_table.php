<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dim_produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id')->unique();
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama_produk');
            $table->string('nama_kategori');
            $table->string('merek')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('warna')->nullable();
            $table->decimal('harga_beli', 12, 2)->default(0);
            $table->decimal('harga_jual', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dim_produks');
    }
};