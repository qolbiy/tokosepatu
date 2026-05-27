@extends('layouts.admin')

@section('title', 'Tambah Kategori - ShoeDW')
@section('page-title', 'Tambah Kategori')
@section('page-subtitle', 'Tambahkan data kategori produk sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Form Kategori</span>
            <h2>Tambah Data Kategori</h2>
            <p>Isi form berikut untuk menambahkan kategori produk sepatu.</p>
        </div>

        <a href="{{ route('kategori.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <form action="{{ route('kategori.store') }}" method="POST" class="crud-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Kode Kategori</label>
                <input type="text" name="kode_kategori" value="{{ old('kode_kategori') }}" placeholder="Contoh: SNK">

                @error('kode_kategori')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" placeholder="Contoh: Sneakers">

                @error('nama_kategori')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi kategori">{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                    <small>{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="crud-button">
                Simpan Data
            </button>

            <a href="{{ route('kategori.index') }}" class="crud-button secondary">
                Batal
            </a>
        </div>
    </form>
</section>
@endsection