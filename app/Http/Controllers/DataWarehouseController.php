<?php

namespace App\Http\Controllers;

use App\Models\DimKategori;
use App\Models\DimPelanggan;
use App\Models\DimProduk;
use App\Models\DimWaktu;
use App\Models\FactPenjualan;
use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DataWarehouseController extends Controller
{

    public function etl()
    {
        $totalTransaksi = \App\Models\Transaksi::count();
        $totalTransaksiSelesai = \App\Models\Transaksi::where('status', 'Selesai')->count();
        $totalFactPenjualan = \App\Models\FactPenjualan::count();

        return view('data-warehouse.etl', compact(
            'totalTransaksi',
            'totalTransaksiSelesai',
            'totalFactPenjualan'
        ));
    }

    public function index()
    {
        $totalDimPelanggan = DimPelanggan::count();
        $totalDimKategori = DimKategori::count();
        $totalDimProduk = DimProduk::count();
        $totalDimWaktu = DimWaktu::count();
        $totalFactPenjualan = FactPenjualan::count();

        return view('data-warehouse.index', compact(
            'totalDimPelanggan',
            'totalDimKategori',
            'totalDimProduk',
            'totalDimWaktu',
            'totalFactPenjualan'
        ));
    }

 public function prosesEtl()
{
    $this->resetDataWarehouse();

    $this->loadDimPelanggan();
    $this->loadDimKategori();
    $this->loadDimProduk();
    $this->loadDimWaktu();
    $this->loadFactPenjualan();

    return redirect()
        ->route('proses-etl.index')
        ->with('success', 'Proses ETL berhasil dijalankan.');
}

    private function resetDataWarehouse()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        FactPenjualan::truncate();
        DimWaktu::truncate();
        DimProduk::truncate();
        DimKategori::truncate();
        DimPelanggan::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function loadDimPelanggan()
    {
        $pelanggans = Pelanggan::all();

        foreach ($pelanggans as $pelanggan) {
            DimPelanggan::updateOrCreate(
                ['pelanggan_id' => $pelanggan->id],
                [
                    'nama_pelanggan' => $pelanggan->nama_pelanggan,
                    'email' => $pelanggan->email,
                    'no_hp' => $pelanggan->no_hp,
                    'alamat' => $pelanggan->alamat,
                    'jenis_kelamin' => $pelanggan->jenis_kelamin,
                ]
            );
        }
    }

    private function loadDimKategori()
    {
        $kategoris = Kategori::all();

        foreach ($kategoris as $kategori) {
            DimKategori::updateOrCreate(
                ['kategori_id' => $kategori->id],
                [
                    'kode_kategori' => $kategori->kode_kategori,
                    'nama_kategori' => $kategori->nama_kategori,
                    'deskripsi' => $kategori->deskripsi,
                ]
            );
        }
    }

    private function loadDimProduk()
    {
        $produks = Produk::with('kategori')->get();

        foreach ($produks as $produk) {
            DimProduk::updateOrCreate(
                ['produk_id' => $produk->id],
                [
                    'kategori_id' => $produk->kategori_id,
                    'nama_produk' => $produk->nama_produk,
                    'nama_kategori' => $produk->kategori->nama_kategori ?? '-',
                    'merek' => $produk->merek,
                    'ukuran' => $produk->ukuran,
                    'warna' => $produk->warna,
                    'harga_beli' => $produk->harga_beli,
                    'harga_jual' => $produk->harga_jual,
                ]
            );
        }
    }

    private function loadDimWaktu()
    {
        $transaksis = Transaksi::where('status', 'Selesai')->get();

        foreach ($transaksis as $transaksi) {
            $tanggal = Carbon::parse($transaksi->tanggal_transaksi);

            DimWaktu::updateOrCreate(
                ['tanggal' => $tanggal->format('Y-m-d')],
                [
                    'hari' => $tanggal->day,
                    'bulan' => $tanggal->month,
                    'nama_bulan' => $this->namaBulanIndonesia($tanggal->month),
                    'tahun' => $tanggal->year,
                    'kuartal' => 'Q' . $tanggal->quarter,
                ]
            );
        }
    }

    private function loadFactPenjualan()
    {
        $transaksis = Transaksi::with([
            'pelanggan',
            'detailTransaksi.produk.kategori',
        ])
            ->where('status', 'Selesai')
            ->get();

        foreach ($transaksis as $transaksi) {
            $detail = $transaksi->detailTransaksi;

            if (!$detail || !$detail->produk) {
                continue;
            }

            $produk = $detail->produk;
            $kategori = $produk->kategori;
            $tanggal = Carbon::parse($transaksi->tanggal_transaksi);

            $dimPelanggan = DimPelanggan::where('pelanggan_id', $transaksi->pelanggan_id)->first();
            $dimProduk = DimProduk::where('produk_id', $produk->id)->first();
            $dimKategori = DimKategori::where('kategori_id', $produk->kategori_id)->first();
            $dimWaktu = DimWaktu::where('tanggal', $tanggal->format('Y-m-d'))->first();

            if (!$dimPelanggan || !$dimProduk || !$dimKategori || !$dimWaktu) {
                continue;
            }

            FactPenjualan::updateOrCreate(
                [
                    'transaksi_id' => $transaksi->id,
                    'detail_transaksi_id' => $detail->id,
                ],
                [
                    'dim_pelanggan_id' => $dimPelanggan->id,
                    'dim_produk_id' => $dimProduk->id,
                    'dim_kategori_id' => $dimKategori->id,
                    'dim_waktu_id' => $dimWaktu->id,
                    'kode_transaksi' => $transaksi->kode_transaksi,
                    'jumlah' => $detail->jumlah,
                    'harga_satuan' => $detail->harga_satuan,
                    'subtotal' => $detail->subtotal,
                    'total_harga' => $transaksi->total_harga,
                    'status' => $transaksi->status,
                ]
            );
        }
    }

    private function namaBulanIndonesia($bulan)
    {
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $namaBulan[$bulan];
    }
}
