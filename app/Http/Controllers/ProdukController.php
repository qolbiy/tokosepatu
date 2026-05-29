<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $produks = Produk::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('nama_produk', 'like', '%' . $search . '%')
                    ->orWhere('merek', 'like', '%' . $search . '%')
                    ->orWhere('ukuran', 'like', '%' . $search . '%')
                    ->orWhere('warna', 'like', '%' . $search . '%')
                    ->orWhere('stok', 'like', '%' . $search . '%')
                    ->orWhere('harga_jual', 'like', '%' . $search . '%')
                    ->orWhereHas('kategori', function ($kategoriQuery) use ($search) {
                        $kategoriQuery->where('nama_kategori', 'like', '%' . $search . '%')
                            ->orWhere('kode_kategori', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('produks', 'search'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_produk' => 'required|string|max:255',
            'merek' => 'nullable|string|max:255',
            'ukuran' => 'nullable|string|max:255',
            'warna' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $namaFile = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('produk', $namaFile, 'public');

            $validated['foto'] = $namaFile;
        }

        Produk::create($validated);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Data produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load('kategori');

        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
{
    $validated = $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'nama_produk' => 'required|string|max:255',
        'merek' => 'nullable|string|max:255',
        'ukuran' => 'nullable|string|max:255',
        'warna' => 'nullable|string|max:255',
        'stok' => 'required|integer|min:0',
        'harga_beli' => 'required|numeric|min:0',
        'harga_jual' => 'required|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');

        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

        $file->storeAs('produk', $filename, 'public');

        $validated['foto'] = $filename;
    }

    $produk->update($validated);

    return redirect()
        ->route('produk.index')
        ->with('success', 'Data produk berhasil diperbarui.');
}

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Data produk berhasil dihapus.');
    }
}
