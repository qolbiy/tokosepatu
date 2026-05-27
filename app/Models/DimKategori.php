<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimKategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'kode_kategori',
        'nama_kategori',
        'deskripsi',
    ];
}