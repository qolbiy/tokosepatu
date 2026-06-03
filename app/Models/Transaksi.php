<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'pelanggan_id',
        'tanggal_transaksi',
        'total_harga',
        'status',
        'metode_pembayaran',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detailTransaksi()
    {
        return $this->hasOne(DetailTransaksi::class);
    }

    public function konfirmasi(Transaksi $transaksi)
{
    if ($transaksi->status !== 'Pending') {
        return redirect()
            ->route('transaksi.index')
            ->with('error', 'Transaksi ini tidak memerlukan konfirmasi.');
    }

    $transaksi->update([
        'status' => 'Selesai',
    ]);

    return redirect()
        ->route('transaksi.index')
        ->with('success', 'Transaksi berhasil dikonfirmasi.');
}
}