<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'merek',
        'ukuran',
        'warna',
        'stok',
        'harga_beli',
        'harga_jual',
        'deskripsi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
        
    }

    public function detailTransaksis()
{
    return $this->hasMany(DetailTransaksi::class);
}
}