<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\FactPenjualan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalKategori = Kategori::count();
        $totalProduk = Produk::count();
        $totalTransaksi = Transaksi::count();

        $totalPendapatan = FactPenjualan::sum('total_harga');
        $produkTerjual = FactPenjualan::sum('jumlah');

        $bulanTerakhir = DB::table('fact_penjualans')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
            ->select('dim_waktus.bulan', 'dim_waktus.tahun')
            ->orderByDesc('dim_waktus.tahun')
            ->orderByDesc('dim_waktus.bulan')
            ->first();

        $persentasePendapatan = 0;
        $statusPendapatan = 'Stabil';

        if ($bulanTerakhir) {
            $bulanIni = $bulanTerakhir->bulan;
            $tahunIni = $bulanTerakhir->tahun;

            $bulanLalu = $bulanIni == 1 ? 12 : $bulanIni - 1;
            $tahunBulanLalu = $bulanIni == 1 ? $tahunIni - 1 : $tahunIni;

            $pendapatanBulanIni = DB::table('fact_penjualans')
                ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
                ->where('dim_waktus.bulan', $bulanIni)
                ->where('dim_waktus.tahun', $tahunIni)
                ->sum('fact_penjualans.total_harga');

            $pendapatanBulanLalu = DB::table('fact_penjualans')
                ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
                ->where('dim_waktus.bulan', $bulanLalu)
                ->where('dim_waktus.tahun', $tahunBulanLalu)
                ->sum('fact_penjualans.total_harga');

            if ($pendapatanBulanLalu > 0) {
                $persentasePendapatan = (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100;
                $statusPendapatan = $persentasePendapatan >= 0 ? 'Naik' : 'Turun';
            }
        }

        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $bulanLalu = Carbon::now()->subMonth()->month;
        $tahunBulanLalu = Carbon::now()->subMonth()->year;

        $pendapatanBulanIni = DB::table('fact_penjualans')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
            ->where('dim_waktus.bulan', $bulanIni)
            ->where('dim_waktus.tahun', $tahunIni)
            ->sum('fact_penjualans.total_harga');

        $pendapatanBulanLalu = DB::table('fact_penjualans')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
            ->where('dim_waktus.bulan', $bulanLalu)
            ->where('dim_waktus.tahun', $tahunBulanLalu)
            ->sum('fact_penjualans.total_harga');

        if ($pendapatanBulanLalu > 0) {
            $persentasePendapatan = (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100;
        } else {
            $persentasePendapatan = 0;
        }

        $statusPendapatan = $persentasePendapatan >= 0 ? 'Naik' : 'Turun';

        $pendapatanBulanan = DB::table('fact_penjualans')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
            ->select(
                'dim_waktus.bulan',
                'dim_waktus.nama_bulan',
                'dim_waktus.tahun',
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy('dim_waktus.bulan', 'dim_waktus.nama_bulan', 'dim_waktus.tahun')
            ->orderBy('dim_waktus.tahun')
            ->orderBy('dim_waktus.bulan')
            ->get();

        $labelPendapatanDashboard = $pendapatanBulanan->pluck('nama_bulan')->values();
        $dataPendapatanDashboard = $pendapatanBulanan->pluck('total_pendapatan')->values();

        $produkTerlaris = DB::table('fact_penjualans')
            ->join('dim_produks', 'fact_penjualans.dim_produk_id', '=', 'dim_produks.id')
            ->select(
                'dim_produks.nama_produk',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual')
            )
            ->groupBy('dim_produks.nama_produk')
            ->orderByDesc('total_terjual')
            ->first();

        $kategoriTerlaris = DB::table('fact_penjualans')
            ->join('dim_kategoris', 'fact_penjualans.dim_kategori_id', '=', 'dim_kategoris.id')
            ->select(
                'dim_kategoris.nama_kategori',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual')
            )
            ->groupBy('dim_kategoris.nama_kategori')
            ->orderByDesc('total_terjual')
            ->first();

        $transaksiTerbaru = Transaksi::with(['pelanggan', 'detailTransaksi.produk.kategori'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalPelanggan',
            'totalKategori',
            'totalProduk',
            'totalTransaksi',
            'totalPendapatan',
            'produkTerjual',
            'persentasePendapatan',
            'statusPendapatan',
            'persentasePendapatan',
            'statusPendapatan',
            'labelPendapatanDashboard',
            'dataPendapatanDashboard',
            'produkTerlaris',
            'kategoriTerlaris',
            'transaksiTerbaru'
        ));
    }
}
