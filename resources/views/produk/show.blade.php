@extends('layouts.admin')

@section('title', 'Detail Produk - ShoeDW')
@section('page-title', 'Detail Produk')
@section('page-subtitle', 'Informasi lengkap data produk sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Detail Data</span>
            <h2>{{ $produk->nama_produk }}</h2>
            <p>Detail data produk sepatu.</p>
        </div>

        <a href="{{ route('produk.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <div class="detail-grid">
        <div class="detail-item">
            <span>Nama Produk</span>
            <strong>{{ $produk->nama_produk }}</strong>
        </div>

        <div class="detail-item">
            <span>Kategori</span>
            <strong>{{ $produk->kategori->nama_kategori ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>Merek</span>
            <strong>{{ $produk->merek ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>Ukuran</span>
            <strong>{{ $produk->ukuran ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>Warna</span>
            <strong>{{ $produk->warna ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>Stok</span>
            <strong>{{ $produk->stok }}</strong>
        </div>

        <div class="detail-item">
            <span>Harga Beli</span>
            <strong>Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</strong>
        </div>

        <div class="detail-item">
            <span>Harga Jual</span>
            <strong>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</strong>
        </div>

        <div class="detail-item full">
            <span>Deskripsi</span>
            <strong>{{ $produk->deskripsi ?? '-' }}</strong>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('produk.edit', $produk->id) }}" class="crud-button">
            Edit Data
        </a>

        <a href="{{ route('produk.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>
</section>
@endsection