@extends('layouts.admin')

@section('title', 'Detail Transaksi - ShoeDW')
@section('page-title', 'Detail Transaksi')
@section('page-subtitle', 'Informasi lengkap transaksi penjualan sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Detail Transaksi</span>
            <h2>{{ $transaksi->kode_transaksi }}</h2>
            <p>Detail transaksi penjualan sepatu.</p>
        </div>

        <a href="{{ route('transaksi.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <div class="detail-grid">
        <div class="detail-item">
            <span>Kode Transaksi</span>
            <strong>{{ $transaksi->kode_transaksi }}</strong>
        </div>

        <div class="detail-item">
            <span>Tanggal Transaksi</span>
            <strong>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</strong>
        </div>

        <div class="detail-item">
            <span>Nama Pelanggan</span>
            <strong>{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>Status</span>
            <strong>{{ $transaksi->status }}</strong>
        </div>

        <div class="detail-item">
            <span>Produk</span>
            <strong>{{ $transaksi->detailTransaksi->produk->nama_produk ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>Kategori Produk</span>
            <strong>{{ $transaksi->detailTransaksi->produk->kategori->nama_kategori ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>Jumlah</span>
            <strong>{{ $transaksi->detailTransaksi->jumlah ?? 0 }}</strong>
        </div>

        <div class="detail-item">
            <span>Harga Satuan</span>
            <strong>
                Rp {{ number_format($transaksi->detailTransaksi->harga_satuan ?? 0, 0, ',', '.') }}
            </strong>
        </div>

        <div class="detail-item full">
            <span>Total Harga</span>
            <strong>
                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
            </strong>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="crud-button">
            Edit Data
        </a>

        <a href="{{ route('transaksi.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>
</section>
@endsection