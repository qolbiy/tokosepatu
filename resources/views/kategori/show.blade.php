@extends('layouts.admin')

@section('title', 'Detail Kategori - ShoeDW')
@section('page-title', 'Detail Kategori')
@section('page-subtitle', 'Informasi lengkap data kategori produk sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Detail Data</span>
            <h2>{{ $kategori->nama_kategori }}</h2>
            <p>Detail data kategori produk sepatu.</p>
        </div>

        <a href="{{ route('kategori.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <div class="detail-grid">
        <div class="detail-item">
            <span>Kode Kategori</span>
            <strong>{{ $kategori->kode_kategori }}</strong>
        </div>

        <div class="detail-item">
            <span>Nama Kategori</span>
            <strong>{{ $kategori->nama_kategori }}</strong>
        </div>

        <div class="detail-item full">
            <span>Deskripsi</span>
            <strong>{{ $kategori->deskripsi ?? '-' }}</strong>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('kategori.edit', $kategori->id) }}" class="crud-button">
            Edit Data
        </a>

        <a href="{{ route('kategori.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>
</section>
@endsection