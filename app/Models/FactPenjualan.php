<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactPenjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'detail_transaksi_id',
        'dim_pelanggan_id',
        'dim_produk_id',
        'dim_kategori_id',
        'dim_waktu_id',
        'kode_transaksi',
        'jumlah',
        'harga_satuan',
        'subtotal',
        'total_harga',
        'status',
    ];
}