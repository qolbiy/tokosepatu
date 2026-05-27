<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ShoeDW</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <div class="admin-overlay" id="adminOverlay"></div>
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-brand-wrapper">
                <div class="admin-brand">
                    <span class="brand-icon"></span>
                    <span>Shoe<span>DW</span></span>
                </div>

                <button class="sidebar-collapse-btn" id="sidebarCollapseBtn" type="button">
                    <span></span>
                </button>
            </div>

            <nav class="admin-menu">
                <a href="{{ route('dashboard') }}" class="active">
                    <span>DB</span>
                    Dashboard
                </a>

                <a href="{{ route('pelanggan.index') }}">
                    <span>PL</span>
                    Data Pelanggan
                </a>

                <a href="{{ route('kategori.index') }}">
                    <span>KT</span>
                    Data Kategori
                </a>

                <a href="{{ route('produk.index') }}">
                    <span>PR</span>
                    Data Produk
                </a>

                <a href="{{ route('transaksi.index') }}">
                    <span>PR</span>
                    Data Transaksi
                </a>

                <a href="{{ route('proses-etl.index') }}" class="{{ request()->routeIs('proses-etl.*') ? 'active' : '' }}">
                    <span>ETL</span>
                    Proses ETL
                </a>

                <a href="{{ route('data-warehouse.index') }}" class="{{ request()->routeIs('data-warehouse.*') ? 'active' : '' }}">
                    <span>DW</span>
                    Data Warehouse
                </a>

                <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <span>LP</span>
                    Laporan
                </a>

                <div class="admin-sidebar-footer">
                    <a href="{{ route('landing') }}">Kembali ke Landing Page</a>
                </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <button class="admin-menu-toggle" id="adminMenuToggle" type="button">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div>
                    <h1>Dashboard Admin</h1>
                    <p>Selamat datang, {{ Auth::user()->name }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-button">
                        Logout
                    </button>
                </form>
            </header>

            <main class="admin-content">
                <section class="admin-hero-card">
                    <div>
                        <span class="hero-badge">Sistem Data Warehouse Toko Sepatu</span>

                        <h2>
                            Kelola Data Operasional dan Pantau Performa Toko
                        </h2>

                        <p>
                            Dashboard ini digunakan admin untuk mengelola data toko sepatu,
                            menjalankan proses ETL, melihat data warehouse, dan memantau
                            laporan analisis penjualan.
                        </p>
                    </div>

                    <div class="admin-hero-visual">
                        <div class="mini-dashboard-card">
                            <span>Total Pendapatan</span>
                            <strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
                            <small>
                                {{ $statusPendapatan }}
                                {{ number_format(abs($persentasePendapatan), 1, ',', '.') }}%
                                dari bulan sebelumnya
                            </small>
                        </div>
                    </div>
                </section>

                <section class="admin-stats">
                    <div class="admin-stat-card">
                        <span>Total Transaksi</span>
                        <strong>{{ $totalTransaksi }}</strong>
                        <p>Total transaksi penjualan sepatu.</p>
                    </div>

                    <div class="admin-stat-card">
                        <span>Total Pelanggan</span>
                        <strong>{{ $totalPelanggan }}</strong>
                        <p>Pelanggan yang terdaftar pada sistem.</p>
                    </div>

                    <div class="admin-stat-card">
                        <span>Total Produk Sepatu</span>
                        <strong>{{ $totalProduk }}</strong>
                        <p>Produk sepatu yang tersedia di toko.</p>
                    </div>

                    <div class="admin-stat-card">
                        <span>Total Pendapatan</span>
                        <strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
                        <p>Total pendapatan dari penjualan sepatu.</p>
                    </div>
                </section>

                <section class="dashboard-overview">
                    <div class="dashboard-chart-card">
                        <div class="admin-section-title">
                            <h2>Grafik Pendapatan</h2>
                            <p>
                                Menampilkan perkembangan pendapatan penjualan sepatu
                                berdasarkan bulan.
                            </p>
                        </div>

                        <div class="chart-box">
                            <canvas id="dashboardRevenueChart"></canvas>

                            <div
                                id="dashboardRevenueChartData"
                                data-labels='{{ $labelPendapatanDashboard->toJson() }}'
                                data-values='{{ $dataPendapatanDashboard->toJson() }}'></div>
                        </div>
                    </div>

                    <div class="quick-insight-card">
                        <div class="admin-section-title">
                            <h2>Insight Cepat</h2>
                            <p>
                                Ringkasan performa toko sepatu berdasarkan hasil analisis data penjualan.
                            </p>
                        </div>

                        <div class="insight-circle-item">
                            <div class="circle-progress" style="--value: 85;">
                                <span>{{ $produkTerlaris->total_terjual ?? 0 }}</span>
                            </div>

                            <div>
                                <h3>Produk Terlaris</h3>
                                <strong>{{ $produkTerlaris->nama_produk ?? 'Belum ada data' }}</strong>
                                <p>Produk dengan jumlah penjualan tertinggi dari data warehouse.</p>
                            </div>
                        </div>

                        <div class="insight-circle-item">
                            <div class="circle-progress" style="--value: 70;">
                                <span>{{ $kategoriTerlaris->total_terjual ?? 0 }}</span>
                            </div>

                            <div>
                                <h3>Kategori Terlaris</h3>
                                <strong>{{ $kategoriTerlaris->nama_kategori ?? 'Belum ada data' }}</strong>
                                <p>Kategori sepatu yang paling banyak terjual.</p>
                            </div>
                        </div>

                        <div class="insight-circle-item">
                            <div class="circle-progress" style="--value: {{ min(abs($persentasePendapatan), 100) }};">
                                <span>{{ number_format(abs($persentasePendapatan), 1, ',', '.') }}%</span>
                            </div>

                            <div>
                                <h3>Pertumbuhan Pendapatan</h3>
                                <strong>{{ $statusPendapatan }} dari bulan sebelumnya</strong>
                                <p>Perbandingan pendapatan bulan terakhir dengan bulan sebelumnya.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="latest-transaction-card">
                    <div class="admin-section-title">
                        <h2>Transaksi Terbaru</h2>
                        <p>
                            Menampilkan beberapa transaksi penjualan sepatu terbaru
                            yang masuk ke sistem.
                        </p>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Total</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
    @forelse ($transaksiTerbaru as $transaksi)
        <tr>
            <td>{{ $transaksi->kode_transaksi }}</td>
            <td>{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</td>
            <td>{{ $transaksi->detailTransaksi->produk->nama_produk ?? '-' }}</td>
            <td>{{ $transaksi->detailTransaksi->produk->kategori->nama_kategori ?? '-' }}</td>
            <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="empty-table">
                Belum ada data transaksi.
            </td>
        </tr>
    @endforelse
</tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>

</html>