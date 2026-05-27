<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DimWaktu extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'hari',
        'bulan',
        'nama_bulan',
        'tahun',
        'kuartal',
    ];
}