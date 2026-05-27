<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\FactPenjualan;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $totalTransaksi = Transaksi::count();
        $totalPendapatan = FactPenjualan::sum('total_harga');

        $produkTerlaris = DB::table('fact_penjualans')
            ->join('dim_produks', 'fact_penjualans.dim_produk_id', '=', 'dim_produks.id')
            ->select(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori',
                'dim_produks.harga_jual',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual'),
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori',
                'dim_produks.harga_jual'
            )
            ->orderByDesc('total_terjual')
            ->first();

        $pendapatanBulanan = DB::table('fact_penjualans')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
            ->select(
                'dim_waktus.bulan',
                'dim_waktus.nama_bulan',
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy('dim_waktus.bulan', 'dim_waktus.nama_bulan')
            ->orderBy('dim_waktus.bulan')
            ->get();

        $kategoriTerlarisLanding = DB::table('fact_penjualans')
            ->join('dim_kategoris', 'fact_penjualans.dim_kategori_id', '=', 'dim_kategoris.id')
            ->select(
                'dim_kategoris.nama_kategori',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual')
            )
            ->groupBy('dim_kategoris.nama_kategori')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $produkTerlarisLanding = DB::table('fact_penjualans')
            ->join('dim_produks', 'fact_penjualans.dim_produk_id', '=', 'dim_produks.id')
            ->select(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual'),
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori'
            )
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $labelPendapatanLanding = $pendapatanBulanan->pluck('nama_bulan')->values();
        $dataPendapatanLanding = $pendapatanBulanan->pluck('total_pendapatan')->values();

        $labelKategoriLanding = $kategoriTerlarisLanding->pluck('nama_kategori')->values();
        $dataKategoriLanding = $kategoriTerlarisLanding->pluck('total_terjual')->values();

        $labelProdukTerlarisLanding = $produkTerlarisLanding->pluck('nama_produk')->values();
        $dataProdukTerlarisLanding = $produkTerlarisLanding->pluck('total_terjual')->values();

        return view('landing', compact(
            'totalProduk',
            'totalKategori',
            'totalTransaksi',
            'totalPendapatan',
            'produkTerlaris',
            'produkTerlarisLanding',
            'labelPendapatanLanding',
            'dataPendapatanLanding',
            'labelKategoriLanding',
            'dataKategoriLanding',
            'labelProdukTerlarisLanding',
            'dataProdukTerlarisLanding'
        ));
    }
}
