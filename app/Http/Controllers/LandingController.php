<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\FactPenjualan;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $totalTransaksi = Transaksi::count();
        $totalProdukTerjual = FactPenjualan::sum('jumlah');

        $produkTerlaris = DB::table('fact_penjualans')
            ->join('dim_produks', 'fact_penjualans.dim_produk_id', '=', 'dim_produks.id')
            ->leftJoin('produks', 'dim_produks.produk_id', '=', 'produks.id')
            ->select(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori',
                'dim_produks.harga_jual',
                'produks.foto',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual'),
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori',
                'dim_produks.harga_jual',
                'produks.foto'
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
            ->leftJoin('produks', 'dim_produks.produk_id', '=', 'produks.id')
            ->select(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori',
                'produks.foto',
                DB::raw('SUM(fact_penjualans.jumlah) as total_terjual'),
                DB::raw('SUM(fact_penjualans.total_harga) as total_pendapatan')
            )
            ->groupBy(
                'dim_produks.nama_produk',
                'dim_produks.nama_kategori',
                'produks.foto'
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

        /*
|--------------------------------------------------------------------------
| Filter Produk Landing Page
|--------------------------------------------------------------------------
| Filter ini digunakan untuk menampilkan produk berdasarkan kategori
| dan merek pada halaman landing page.
*/
        $kategoriId = $request->input('kategori');
        $merek = $request->input('merek');

        $produkLanding = Produk::with('kategori')
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->where('kategori_id', $kategoriId);
            })
            ->when($merek, function ($query, $merek) {
                $query->where('merek', $merek);
            })
            ->latest()
            ->limit(20)
            ->get();

        $kategoriFilterLanding = Kategori::orderBy('nama_kategori', 'asc')->get();

        $merekFilterLanding = Produk::select('merek')
            ->whereNotNull('merek')
            ->where('merek', '!=', '')
            ->distinct()
            ->orderBy('merek', 'asc')
            ->pluck('merek');

        $testimoniPelanggan = Pelanggan::latest()
            ->limit(8)
            ->get();

        return view('landing', compact(
            'totalProduk',
            'totalKategori',
            'totalTransaksi',
            'totalProdukTerjual',
            'produkTerlaris',
            'produkTerlarisLanding',
            'labelPendapatanLanding',
            'dataPendapatanLanding',
            'labelKategoriLanding',
            'dataKategoriLanding',
            'labelProdukTerlarisLanding',
            'dataProdukTerlarisLanding',
            'produkLanding',
            'kategoriFilterLanding',
            'merekFilterLanding',
            'kategoriId',
            'merek',
            'testimoniPelanggan',
        ));
    }

    public function showProduk(Produk $produk)
    {
        $produk->load('kategori');

        return view('landing-produk-detail', compact('produk'));
    }

    public function simpanCheckout(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:500',
            'ukuran' => 'required|string|max:10',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:COD,Transfer Bank,QRIS Simulasi',
        ]);

        DB::beginTransaction();

        try {
            $produk = Produk::findOrFail($validated['produk_id']);

            if ($produk->stok < $validated['jumlah']) {
                return redirect()
                    ->to(route('landing') . '#produk')
                    ->with('error', 'Stok produk tidak mencukupi.');
            }

            $pelanggan = Pelanggan::create([
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'alamat' => $validated['alamat'],
            ]);

            $subtotal = $produk->harga_jual * $validated['jumlah'];

            $statusTransaksi = $validated['metode_pembayaran'] === 'COD'
                ? 'Selesai'
                : 'Pending';

            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX-' . strtoupper(Str::random(8)),
                'pelanggan_id' => $pelanggan->id,
                'tanggal_transaksi' => now(),
                'total_harga' => $subtotal,
                'status' => $statusTransaksi,
                'metode_pembayaran' => $validated['metode_pembayaran'],
                'payment_deadline' => $statusTransaksi === 'Pending'
                    ? now()->addMinutes(1)
                    : null,
                'confirmed_at' => $statusTransaksi === 'Selesai'
                    ? now()
                    : null,
            ]);

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk->id,
                'ukuran' => $validated['ukuran'],
                'jumlah' => $validated['jumlah'],
                'harga_satuan' => $produk->harga_jual,
                'subtotal' => $subtotal,
            ]);

            $produk->decrement('stok', $validated['jumlah']);

            DB::commit();

            if ($statusTransaksi === 'Pending') {
                return redirect()
                    ->route('checkout.pending', $transaksi->id)
                    ->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran sebelum batas waktu habis.');
            }

            return redirect()
                ->to(route('landing') . '#produk')
                ->with('success', 'Pesanan berhasil dibuat dengan metode COD. Transaksi langsung berstatus Selesai.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->to(route('landing') . '#produk')
                ->with('error', 'Pesanan gagal dibuat: ' . $e->getMessage());
        }
    }

    public function checkoutPending(Transaksi $transaksi)
    {
        $transaksi->load([
            'pelanggan',
            'detailTransaksi.produk',
        ]);

        return view('checkout-pending', compact('transaksi'));
    }

    public function checkoutStatus(Transaksi $transaksi)
    {
        return response()->json([
            'status' => $transaksi->status,
            'confirmed_at' => $transaksi->confirmed_at
                ? \Carbon\Carbon::parse($transaksi->confirmed_at)->format('d M Y H:i')
                : null,
        ]);
    }

    public function checkoutExpired(Transaksi $transaksi)
    {
        if ($transaksi->status !== 'Pending') {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak dapat diubah menjadi kadaluarsa.',
                'status' => $transaksi->status,
            ]);
        }

        DB::beginTransaction();

        try {
            $transaksi->load('detailTransaksi.produk');

            if ($transaksi->detailTransaksi && $transaksi->detailTransaksi->produk) {
                $transaksi->detailTransaksi->produk->increment(
                    'stok',
                    $transaksi->detailTransaksi->jumlah
                );
            }

            $transaksi->update([
                'status' => 'Kadaluarsa',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Batas waktu pembayaran telah habis. Silakan ulangi pesanan.',
                'status' => 'Kadaluarsa',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status transaksi: ' . $e->getMessage(),
            ], 500);
        }
    }
}
