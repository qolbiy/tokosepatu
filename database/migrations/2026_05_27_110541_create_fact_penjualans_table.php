<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fact_penjualans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('transaksi_id')->unique();
            $table->unsignedBigInteger('detail_transaksi_id')->unique();

            $table->unsignedBigInteger('dim_pelanggan_id');
            $table->unsignedBigInteger('dim_produk_id');
            $table->unsignedBigInteger('dim_kategori_id');
            $table->unsignedBigInteger('dim_waktu_id');

            $table->string('kode_transaksi');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->decimal('total_harga', 12, 2);
            $table->string('status');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fact_penjualans');
    }
};