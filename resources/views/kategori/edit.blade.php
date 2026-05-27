@extends('layouts.admin')

@section('title', 'Edit Kategori - ShoeDW')
@section('page-title', 'Edit Kategori')
@section('page-subtitle', 'Perbarui data kategori produk sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Form Kategori</span>
            <h2>Edit Data Kategori</h2>
            <p>Ubah data kategori produk sepatu sesuai kebutuhan.</p>
        </div>

        <a href="{{ route('kategori.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label>Kode Kategori</label>
                <input type="text" name="kode_kategori" value="{{ old('kode_kategori', $kategori->kode_kategori) }}" placeholder="Contoh: SNK">

                @error('kode_kategori')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Contoh: Sneakers">

                @error('nama_kategori')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi kategori">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                @error('deskripsi')
                    <small>{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="crud-button">
                Update Data
            </button>

            <a href="{{ route('kategori.index') }}" class="crud-button secondary">
                Batal
            </a>
        </div>
    </form>
</section>
@endsection