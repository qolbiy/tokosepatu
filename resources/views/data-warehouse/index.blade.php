@extends('layouts.admin')

@section('title', 'Data Warehouse - ShoeDW')
@section('page-title', 'Data Warehouse')
@section('page-subtitle', 'Lihat hasil data warehouse toko sepatu.')

@section('content')
<section class="crud-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Star Schema</span>
            <h2>Data Warehouse Penjualan Sepatu</h2>
            <p>
                Halaman ini menampilkan ringkasan data warehouse hasil proses ETL
                dari database operasional ke tabel dimensi dan tabel fakta.
            </p>
        </div>

        <a href="{{ route('proses-etl.index') }}" class="crud-button">
            Ke Proses ETL
        </a>
    </div>

    @if (session('success'))
        <div class="crud-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-stats">
        <div class="admin-stat-card">
            <span>Dim Pelanggan</span>
            <strong>{{ $totalDimPelanggan }}</strong>
            <p>Total data pelanggan pada data warehouse.</p>
        </div>

        <div class="admin-stat-card">
            <span>Dim Kategori</span>
            <strong>{{ $totalDimKategori }}</strong>
            <p>Total data kategori pada data warehouse.</p>
        </div>

        <div class="admin-stat-card">
            <span>Dim Produk</span>
            <strong>{{ $totalDimProduk }}</strong>
            <p>Total data produk pada data warehouse.</p>
        </div>

        <div class="admin-stat-card">
            <span>Dim Waktu</span>
            <strong>{{ $totalDimWaktu }}</strong>
            <p>Total data waktu transaksi pada data warehouse.</p>
        </div>

        <div class="admin-stat-card">
            <span>Fact Penjualan</span>
            <strong>{{ $totalFactPenjualan }}</strong>
            <p>Total data fakta penjualan pada data warehouse.</p>
        </div>
    </div>

    <div class="dashboard-overview">
        <div class="dashboard-chart-card">
            <div class="admin-section-title">
                <h2>Model Star Schema</h2>
                <p>
                    Fact penjualan menjadi pusat analisis dan terhubung dengan
                    tabel dimensi pelanggan, kategori, produk, dan waktu.
                </p>
            </div>

            <div class="warehouse-schema-box">
                <div class="warehouse-dim">dim_pelanggans</div>
                <div class="warehouse-dim">dim_kategoris</div>
                <div class="warehouse-fact">
                    fact_penjualans
                    <span>jumlah, harga_satuan, subtotal, total_harga</span>
                </div>
                <div class="warehouse-dim">dim_produks</div>
                <div class="warehouse-dim">dim_waktus</div>
            </div>
        </div>

        <div class="quick-insight-card">
            <div class="admin-section-title">
                <h2>Keterangan Tabel</h2>
                <p>Penjelasan singkat tabel pada data warehouse.</p>
            </div>

            <div class="insight-list">
                <div class="insight-item">
                    <span>Dimensi</span>
                    <strong>dim_pelanggans</strong>
                    <p>Menyimpan data pelanggan dari tabel operasional.</p>
                </div>

                <div class="insight-item">
                    <span>Dimensi</span>
                    <strong>dim_produks</strong>
                    <p>Menyimpan data produk sepatu dan kategori produk.</p>
                </div>

                <div class="insight-item">
                    <span>Dimensi</span>
                    <strong>dim_waktus</strong>
                    <p>Menyimpan informasi tanggal, bulan, tahun, dan kuartal.</p>
                </div>

                <div class="insight-item">
                    <span>Fakta</span>
                    <strong>fact_penjualans</strong>
                    <p>Menyimpan data transaksi penjualan untuk kebutuhan analisis.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection