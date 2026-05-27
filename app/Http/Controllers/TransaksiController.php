<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $transaksis = Transaksi::with(['pelanggan', 'detailTransaksi.produk'])
            ->when($search, function ($query, $search) {
                $query->where('kode_transaksi', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_transaksi', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%')
                    ->orWhereHas('pelanggan', function ($pelangganQuery) use ($search) {
                        $pelangganQuery->where('nama_pelanggan', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('detailTransaksi.produk', function ($produkQuery) use ($search) {
                        $produkQuery->where('nama_produk', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('transaksi.index', compact('transaksis', 'search'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        $produks = Produk::with('kategori')->orderBy('nama_produk')->get();

        return view('transaksi.create', compact('pelanggans', 'produks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'produk_id' => 'required|exists:produks,id',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Selesai,Pending,Dibatalkan',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $produk = Produk::findOrFail($validated['produk_id']);

                if ($validated['status'] === 'Selesai' && $produk->stok < $validated['jumlah']) {
                    throw new \Exception('Stok produk tidak mencukupi.');
                }

                $subtotal = $produk->harga_jual * $validated['jumlah'];

                $transaksi = Transaksi::create([
                    'kode_transaksi' => 'TRX-' . date('YmdHis'),
                    'pelanggan_id' => $validated['pelanggan_id'],
                    'tanggal_transaksi' => $validated['tanggal_transaksi'],
                    'total_harga' => $subtotal,
                    'status' => $validated['status'],
                ]);

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $validated['jumlah'],
                    'harga_satuan' => $produk->harga_jual,
                    'subtotal' => $subtotal,
                ]);

                if ($validated['status'] === 'Selesai') {
                    $produk->decrement('stok', $validated['jumlah']);
                }
            });
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Data transaksi berhasil ditambahkan.');
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'detailTransaksi.produk.kategori']);

        return view('transaksi.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        $transaksi->load('detailTransaksi');

        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();
        $produks = Produk::with('kategori')->orderBy('nama_produk')->get();

        return view('transaksi.edit', compact('transaksi', 'pelanggans', 'produks'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'produk_id' => 'required|exists:produks,id',
            'tanggal_transaksi' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|in:Selesai,Pending,Dibatalkan',
        ]);

        try {
            DB::transaction(function () use ($validated, $transaksi) {
                $transaksi->load('detailTransaksi.produk');

                $detailLama = $transaksi->detailTransaksi;

                if ($transaksi->status === 'Selesai' && $detailLama) {
                    $detailLama->produk->increment('stok', $detailLama->jumlah);
                }

                $produkBaru = Produk::findOrFail($validated['produk_id']);

                if ($validated['status'] === 'Selesai' && $produkBaru->stok < $validated['jumlah']) {
                    throw new \Exception('Stok produk tidak mencukupi.');
                }

                $subtotal = $produkBaru->harga_jual * $validated['jumlah'];

                $transaksi->update([
                    'pelanggan_id' => $validated['pelanggan_id'],
                    'tanggal_transaksi' => $validated['tanggal_transaksi'],
                    'total_harga' => $subtotal,
                    'status' => $validated['status'],
                ]);

                if ($detailLama) {
                    $detailLama->update([
                        'produk_id' => $produkBaru->id,
                        'jumlah' => $validated['jumlah'],
                        'harga_satuan' => $produkBaru->harga_jual,
                        'subtotal' => $subtotal,
                    ]);
                }

                if ($validated['status'] === 'Selesai') {
                    $produkBaru->decrement('stok', $validated['jumlah']);
                }
            });
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Data transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        DB::transaction(function () use ($transaksi) {
            $transaksi->load('detailTransaksi.produk');

            if ($transaksi->status === 'Selesai' && $transaksi->detailTransaksi) {
                $transaksi->detailTransaksi->produk->increment(
                    'stok',
                    $transaksi->detailTransaksi->jumlah
                );
            }

            $transaksi->delete();
        });

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Data transaksi berhasil dihapus.');
    }
}
