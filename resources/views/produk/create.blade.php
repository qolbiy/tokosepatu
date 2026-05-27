@extends('layouts.admin')

@section('title', 'Tambah Produk - ShoeDW')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Tambahkan data produk sepatu baru.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Form Produk</span>
            <h2>Tambah Data Produk</h2>
            <p>Isi form berikut untuk menambahkan data produk sepatu.</p>
        </div>

        <a href="{{ route('produk.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <form action="{{ route('produk.store') }}" method="POST" class="crud-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Contoh: Sneakers Casual">

                @error('nama_produk')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id">
                    <option value="">Pilih kategori</option>

                    @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                    @endforeach
                </select>

                @error('kategori_id')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Merek</label>
                <input type="text" name="merek" value="{{ old('merek') }}" placeholder="Contoh: Nike">

                @error('merek')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Ukuran</label>
                <input type="text" name="ukuran" value="{{ old('ukuran') }}" placeholder="Contoh: 39, 40, 41">

                @error('ukuran')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Warna</label>
                <input type="text" name="warna" value="{{ old('warna') }}" placeholder="Contoh: Hitam">

                @error('warna')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" value="{{ old('stok', 0) }}" min="0" placeholder="Masukkan stok">

                @error('stok')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" value="{{ old('harga_beli', 0) }}" min="0" placeholder="Masukkan harga beli">

                @error('harga_beli')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" value="{{ old('harga_jual', 0) }}" min="0" placeholder="Masukkan harga jual">

                @error('harga_jual')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi produk">{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                <small>{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="crud-button">
                Simpan Data
            </button>

            <a href="{{ route('produk.index') }}" class="crud-button secondary">
                Batal
            </a>
        </div>
    </form>
</section>
@endsection