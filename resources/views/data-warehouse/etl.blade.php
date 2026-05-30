@extends('layouts.admin')

@section('title', 'Proses ETL - ShoeDW')
@section('page-title', 'Proses ETL')
@section('page-subtitle', 'Jalankan proses Extract, Transform, Load ke data warehouse.')

@section('content')
<section class="crud-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">ETL Data Warehouse</span>
            <h2>Proses ETL Penjualan Sepatu</h2>
            <p>
                Halaman ini digunakan untuk memindahkan data operasional dari tabel pelanggan,
                kategori, produk, transaksi, dan detail transaksi ke tabel data warehouse.
            </p>
        </div>

        <!-- Form ETL dengan SweetAlert2 -->
       <form id="etlForm" action="{{ route('proses-etl.jalankan') }}" method="POST">
    @csrf

    <button type="button" class="crud-button" id="etlButton">
        Jalankan ETL
    </button>
</form>
    </div>

    @if (session('success'))
        <div class="crud-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-stats">
        <div class="admin-stat-card">
            <span>Total Transaksi Operasional</span>
            <strong>{{ $totalTransaksi }}</strong>
            <p>Jumlah seluruh transaksi pada database operasional.</p>
        </div>

        <div class="admin-stat-card">
            <span>Transaksi Selesai</span>
            <strong>{{ $totalTransaksiSelesai }}</strong>
            <p>Transaksi yang siap dimasukkan ke data warehouse.</p>
        </div>

        <div class="admin-stat-card">
            <span>Fact Penjualan</span>
            <strong>{{ $totalFactPenjualan }}</strong>
            <p>Jumlah data yang sudah masuk ke tabel fakta.</p>
        </div>
    </div>

    <div class="dashboard-overview">
        <div class="dashboard-chart-card">
            <div class="admin-section-title">
                <h2>Alur Proses ETL</h2>
                <p>
                    Proses ETL mengambil data dari database operasional, mengubahnya menjadi format
                    star schema, lalu memuatnya ke tabel dimensi dan fakta.
                </p>
            </div>

            <div class="insight-list">
                <div class="insight-item">
                    <span>Extract</span>
                    <strong>Ambil Data Operasional</strong>
                    <p>Data diambil dari tabel pelanggan, kategori, produk, transaksi, dan detail transaksi.</p>
                </div>

                <div class="insight-item">
                    <span>Transform</span>
                    <strong>Ubah ke Format Star Schema</strong>
                    <p>Data transaksi diubah menjadi dimensi pelanggan, kategori, produk, waktu, dan fakta penjualan.</p>
                </div>

                <div class="insight-item">
                    <span>Load</span>
                    <strong>Simpan ke Data Warehouse</strong>
                    <p>Data hasil transformasi dimasukkan ke tabel dim dan fact untuk kebutuhan laporan.</p>
                </div>
            </div>
        </div>

        <div class="quick-insight-card">
            <div class="admin-section-title">
                <h2>Target Tabel ETL</h2>
                <p>Tabel data warehouse yang akan diisi saat proses ETL dijalankan.</p>
            </div>

            <div class="insight-list">
                <div class="insight-item">
                    <span>Dimensi</span>
                    <strong>dim_pelanggans</strong>
                    <p>Menyimpan data pelanggan.</p>
                </div>

                <div class="insight-item">
                    <span>Dimensi</span>
                    <strong>dim_kategoris</strong>
                    <p>Menyimpan data kategori sepatu.</p>
                </div>

                <div class="insight-item">
                    <span>Dimensi</span>
                    <strong>dim_produks</strong>
                    <p>Menyimpan data produk sepatu.</p>
                </div>

                <div class="insight-item">
                    <span>Dimensi</span>
                    <strong>dim_waktus</strong>
                    <p>Menyimpan data tanggal transaksi.</p>
                </div>

                <div class="insight-item">
                    <span>Fakta</span>
                    <strong>fact_penjualans</strong>
                    <p>Menyimpan data penjualan utama.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tambahkan SweetAlert2 -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const etlButton = document.getElementById('etlButton');
        const etlForm = document.getElementById('etlForm');

        if (etlButton && etlForm) {
            etlButton.addEventListener('click', function () {
                Swal.fire({
                    title: 'Jalankan Proses ETL?',
                    text: 'Data operasional akan diproses dan dimuat ke data warehouse.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Jalankan',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    confirmButtonColor: '#8b5cf6',
                    cancelButtonColor: '#64748b'
                }).then((result) => {
                    if (result.isConfirmed) {
                        etlForm.submit();
                    }
                });
            });
        }
    });
</script>

@endsection