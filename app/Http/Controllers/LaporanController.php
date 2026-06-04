<?php

namespace App\Http\Controllers;

use App\Models\FactPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $queryLaporan = FactPenjualan::query()
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id');

        if (!empty($bulan)) {
            $queryLaporan->where('dim_waktus.bulan', $bulan);
        }

        if (!empty($tahun)) {
            $queryLaporan->where('dim_waktus.tahun', $tahun);
        }

        $totalPendapatan = (clone $queryLaporan)->sum('fact_penjualans.total_harga');
        $totalTransaksi = (clone $queryLaporan)->count();
        $totalProdukTerjual = (clone $queryLaporan)->sum('fact_penjualans.jumlah');

        $rataRataTransaksi = $totalTransaksi > 0
            ? $totalPendapatan / $totalTransaksi
            : 0;

        $pendapatanBulananQuery = DB::table('fact_penjualans')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id');

        if (!empty($bulan)) {
            $pendapatanBulananQuery->where('dim_waktus.bulan', $bulan);
        }

        if (!empty($tahun)) {
            $pendapatanBulananQuery->where('dim_waktus.tahun', $tahun);
        }

        $pendapatanBulanan = $pendapatanBulananQuery
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

        $produkTerlarisQuery = DB::table('fact_penjualans')
            ->join('dim_produks', 'fact_penjualans.dim_produk_id', '=', 'dim_produks.id')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id');

        if (!empty($bulan)) {
            $produkTerlarisQuery->where('dim_waktus.bulan', $bulan);
        }

        if (!empty($tahun)) {
            $produkTerlarisQuery->where('dim_waktus.tahun', $tahun);
        }

        $produkTerlaris = $produkTerlarisQuery
            ->select(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual'),
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy('dim_produks.nama_produk', 'dim_produks.nama_kategori')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        $kategoriTerlarisQuery = DB::table('fact_penjualans')
            ->join('dim_kategoris', 'fact_penjualans.dim_kategori_id', '=', 'dim_kategoris.id')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id');

        if (!empty($bulan)) {
            $kategoriTerlarisQuery->where('dim_waktus.bulan', $bulan);
        }

        if (!empty($tahun)) {
            $kategoriTerlarisQuery->where('dim_waktus.tahun', $tahun);
        }

        $kategoriTerlaris = $kategoriTerlarisQuery
            ->select(
                'dim_kategoris.nama_kategori',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual'),
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy('dim_kategoris.nama_kategori')
            ->orderByDesc('total_terjual')
            ->get();

        $ringkasanPenjualanQuery = DB::table('fact_penjualans')
            ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
            ->join('dim_produks', 'fact_penjualans.dim_produk_id', '=', 'dim_produks.id')
            ->join('dim_kategoris', 'fact_penjualans.dim_kategori_id', '=', 'dim_kategoris.id');

        if (!empty($bulan)) {
            $ringkasanPenjualanQuery->where('dim_waktus.bulan', $bulan);
        }

        if (!empty($tahun)) {
            $ringkasanPenjualanQuery->where('dim_waktus.tahun', $tahun);
        }

        $ringkasanPenjualan = $ringkasanPenjualanQuery
            ->select(
                'dim_waktus.bulan',
                'dim_waktus.nama_bulan',
                'dim_waktus.tahun',
                'dim_produks.nama_produk',
                'dim_kategoris.nama_kategori',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual'),
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy(
                'dim_waktus.bulan',
                'dim_waktus.nama_bulan',
                'dim_waktus.tahun',
                'dim_produks.nama_produk',
                'dim_kategoris.nama_kategori'
            )
            ->orderBy('dim_waktus.tahun')
            ->orderBy('dim_waktus.bulan')
            ->limit(15)
            ->get();

        $labelKategoriTerlaris = $kategoriTerlaris->pluck('nama_kategori')->values();
        $dataKategoriTerlaris = $kategoriTerlaris->pluck('total_terjual')->values();

        $labelProdukTerlaris = $produkTerlaris->pluck('nama_produk')->values();
        $dataProdukTerlaris = $produkTerlaris->pluck('total_terjual')->values();

        $daftarTahun = DB::table('dim_waktus')
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $daftarBulan = [
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

        return view('laporan.index', compact(
            'totalPendapatan',
            'totalTransaksi',
            'totalProdukTerjual',
            'rataRataTransaksi',
            'pendapatanBulanan',
            'produkTerlaris',
            'kategoriTerlaris',
            'ringkasanPenjualan',
            'labelKategoriTerlaris',
            'dataKategoriTerlaris',
            'labelProdukTerlaris',
            'dataProdukTerlaris',
            'bulan',
            'tahun',
            'daftarBulan',
            'daftarTahun'
        ));
    }

    public function exportPdf(Request $request)
{
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    $baseQuery = DB::table('fact_penjualans')
        ->join('dim_waktus', 'fact_penjualans.dim_waktu_id', '=', 'dim_waktus.id')
        ->join('dim_produks', 'fact_penjualans.dim_produk_id', '=', 'dim_produks.id')
        ->join('dim_kategoris', 'fact_penjualans.dim_kategori_id', '=', 'dim_kategoris.id');

    if (!empty($bulan)) {
        $baseQuery->where('dim_waktus.bulan', $bulan);
    }

    if (!empty($tahun)) {
        $baseQuery->where('dim_waktus.tahun', $tahun);
    }

    $dataPenjualan = (clone $baseQuery)
        ->select(
            'dim_produks.nama_produk',
            'dim_kategoris.nama_kategori',
            DB::raw('SUM(fact_penjualans.jumlah) as total_terjual'),
            DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
        )
        ->groupBy(
            'dim_produks.nama_produk',
            'dim_kategoris.nama_kategori'
        )
        ->orderByDesc('total_terjual')
        ->get();

    $totalPendapatan = (clone $baseQuery)
        ->sum('fact_penjualans.total_harga');

    $totalProdukTerjual = (clone $baseQuery)
        ->sum('fact_penjualans.jumlah');

    $totalTransaksi = (clone $baseQuery)
        ->distinct('fact_penjualans.transaksi_id')
        ->count('fact_penjualans.transaksi_id');

    $rataRataTransaksi = $totalTransaksi > 0
        ? $totalPendapatan / $totalTransaksi
        : 0;

    $kategoriTerlaris = $dataPenjualan
        ->groupBy('nama_kategori')
        ->map(function ($items, $kategori) {
            return [
                'nama_kategori' => $kategori,
                'total_terjual' => $items->sum('total_terjual'),
                'total_pendapatan' => $items->sum('total_pendapatan'),
            ];
        })
        ->sortByDesc('total_terjual')
        ->values();

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

    $periode = 'Semua Periode';

    if (!empty($bulan) && !empty($tahun)) {
        $periode = ($namaBulan[(int) $bulan] ?? 'Bulan') . ' ' . $tahun;
    } elseif (!empty($tahun)) {
        $periode = 'Tahun ' . $tahun;
    }

    $pdf = Pdf::loadView('laporan.pdf', compact(
        'dataPenjualan',
        'kategoriTerlaris',
        'totalPendapatan',
        'totalProdukTerjual',
        'totalTransaksi',
        'rataRataTransaksi',
        'periode'
    ))->setPaper('a4', 'portrait');

    return $pdf->stream('laporan-penjualan-shoedw-' . now()->format('Ymd-His') . '.pdf');
}
}
