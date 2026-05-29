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

    <div class="product-detail-preview">
        <div class="product-detail-image-box">
            <img
                src="{{ $produk->foto ? asset('storage/produk/' . $produk->foto) : asset('storage/produk/default-shoe.jpg') }}"
                alt="{{ $produk->nama_produk }}"
                class="product-detail-img">
        </div>

        <div class="product-detail-summary">
            <span class="product-detail-badge">
                {{ $produk->kategori->nama_kategori ?? 'Kategori Tidak Tersedia' }}
            </span>

            <h3>{{ $produk->nama_produk }}</h3>

            <p>
                {{ $produk->deskripsi ?? 'Belum ada deskripsi produk.' }}
            </p>

            <div class="product-detail-price">
                <span>Harga Jual</span>
                <strong>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</strong>
            </div>
        </div>
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

            @if ($produk->stok <= 0)
                <strong>
                    <span class="status-badge danger">Habis</span>
                </strong>
            @elseif ($produk->stok <= 5)
                <strong>
                    <span class="status-badge warning">{{ $produk->stok }} tersisa</span>
                </strong>
            @else
                <strong>
                    <span class="status-badge success">{{ $produk->stok }}</span>
                </strong>
            @endif
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