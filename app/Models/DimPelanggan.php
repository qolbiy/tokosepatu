<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimPelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'nama_pelanggan',
        'email',
        'no_hp',
        'alamat',
        'jenis_kelamin',
    ];
}