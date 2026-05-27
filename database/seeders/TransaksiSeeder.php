<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DetailTransaksi::truncate();
        Transaksi::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $pelanggans = Pelanggan::all();
        $produks = Produk::all();

        if ($pelanggans->isEmpty() || $produks->isEmpty()) {
            return;
        }

        $bulanTransaksi = [
            ['bulan' => 1, 'nama' => 'Januari'],
            ['bulan' => 2, 'nama' => 'Februari'],
            ['bulan' => 3, 'nama' => 'Maret'],
            ['bulan' => 4, 'nama' => 'April'],
            ['bulan' => 5, 'nama' => 'Mei'],
        ];

        $nomorTransaksi = 1;

        foreach ($bulanTransaksi as $bulan) {
            for ($i = 1; $i <= 20; $i++) {
                $pelanggan = $pelanggans->random();
                $produk = $produks->random();

                $jumlah = rand(1, 4);
                $hargaSatuan = $produk->harga_jual;
                $subtotal = $hargaSatuan * $jumlah;

                $tanggalTransaksi = Carbon::create(
                    2026,
                    $bulan['bulan'],
                    rand(1, 25)
                )->format('Y-m-d');

                $transaksi = Transaksi::create([
                    'kode_transaksi' => 'TRX-' . str_pad($nomorTransaksi, 5, '0', STR_PAD_LEFT),
                    'pelanggan_id' => $pelanggan->id,
                    'tanggal_transaksi' => $tanggalTransaksi,
                    'total_harga' => $subtotal,
                    'status' => 'Selesai',
                ]);

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $hargaSatuan,
                    'subtotal' => $subtotal,
                ]);

                $nomorTransaksi++;
            }
        }
    }
}
