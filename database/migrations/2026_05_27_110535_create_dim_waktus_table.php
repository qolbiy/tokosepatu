<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dim_waktus', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->integer('hari');
            $table->integer('bulan');
            $table->string('nama_bulan');
            $table->integer('tahun');
            $table->string('kuartal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dim_waktus');
    }
};