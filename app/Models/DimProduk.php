<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'kategori_id',
        'nama_produk',
        'nama_kategori',
        'merek',
        'ukuran',
        'warna',
        'harga_beli',
        'harga_jual',
    ];
}