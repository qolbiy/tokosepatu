@extends('layouts.admin')

@section('title', 'Laporan - ShoeDW')
@section('page-title', 'Laporan')
@section('page-subtitle', 'Laporan analisis penjualan toko sepatu.')

@section('content')
<section class="crud-card">
    <div class="crud-header laporan-header">
        <div>
            <span class="hero-badge">Analisis Data Warehouse</span>
            <h2>Laporan Penjualan Sepatu</h2>
            <p>
                Halaman ini menampilkan laporan analisis berdasarkan data warehouse,
                seperti pendapatan, transaksi, produk terlaris, kategori terlaris,
                dan ringkasan penjualan.
            </p>
        </div>

        <a href="{{ route('proses-etl.index') }}" class="crud-button">
            Update ETL
        </a>
    </div>

    <form action="{{ route('laporan.index') }}" method="GET" class="filter-form laporan-filter">
        <div class="filter-group">
            <div class="filter-item">
                <label>Filter Bulan</label>
                <select name="bulan">
                    <option value="">Semua Bulan</option>

                    @foreach ($daftarBulan as $key => $namaBulan)
                    <option value="{{ $key }}" {{ (string) $bulan === (string) $key ? 'selected' : '' }}>
                        {{ $namaBulan }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-item">
                <label>Filter Tahun</label>
                <select name="tahun">
                    <option value="">Semua Tahun</option>

                    @foreach ($daftarTahun as $itemTahun)
                    <option value="{{ $itemTahun }}" {{ (string) $tahun === (string) $itemTahun ? 'selected' : '' }}>
                        {{ $itemTahun }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="crud-button">
                    Terapkan Filter
                </button>

                @if (!empty($bulan) || !empty($tahun))
                <a href="{{ route('laporan.index') }}" class="crud-button secondary">
                    Reset
                </a>
                @endif
            </div>
        </div>
    </form>

    @if (!empty($bulan) || !empty($tahun))
    <div class="search-result-info">
        <p>
            Filter aktif:
            <strong>
                {{ !empty($bulan) ? $daftarBulan[$bulan] : 'Semua Bulan' }}
                -
                {{ !empty($tahun) ? $tahun : 'Semua Tahun' }}
            </strong>
        </p>

        <span>
            Data laporan menyesuaikan filter.
        </span>
    </div>
    @endif

    <div class="admin-stats">
        <div class="admin-stat-card">
            <span>Total Pendapatan</span>
            <strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
            <p>Total pendapatan dari fact penjualan.</p>
        </div>

        <div class="admin-stat-card">
            <span>Total Transaksi</span>
            <strong>{{ $totalTransaksi }}</strong>
            <p>Jumlah transaksi yang masuk ke data warehouse.</p>
        </div>

        <div class="admin-stat-card">
            <span>Produk Terjual</span>
            <strong>{{ $totalProdukTerjual }}</strong>
            <p>Total jumlah produk sepatu yang terjual.</p>
        </div>

        <div class="admin-stat-card">
            <span>Rata-rata Transaksi</span>
            <strong>Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}</strong>
            <p>Rata-rata pendapatan per transaksi.</p>
        </div>
    </div>

    <div class="dashboard-overview">
        <div class="dashboard-chart-card">
            <div class="admin-section-title">
                <h2>Grafik Pendapatan Bulanan</h2>
                <p>
                    Menampilkan pendapatan penjualan sepatu berdasarkan bulan
                    dari hasil proses ETL.
                </p>
            </div>

            <div class="chart-box">
                <canvas id="laporanPendapatanChart"></canvas>

                <div
                    id="laporanChartData"
                    data-labels='{{ $pendapatanBulanan->pluck("nama_bulan")->values()->toJson() }}'
                    data-values='{{ $pendapatanBulanan->pluck("total_pendapatan")->values()->toJson() }}'></div>
            </div>
        </div>

        <div class="quick-insight-card">
            <div class="admin-section-title">
                <h2>Grafik Kategori Terlaris</h2>
                <p>
                    Menampilkan kategori sepatu dengan jumlah penjualan tertinggi.
                </p>
            </div>

            <div class="chart-box chart-box-small">
                <canvas id="kategoriTerlarisChart"></canvas>

                <div
                    id="kategoriChartData"
                    data-labels='{{ $labelKategoriTerlaris->toJson() }}'
                    data-values='{{ $dataKategoriTerlaris->toJson() }}'></div>
            </div>
        </div>
    </div>

    <section class="latest-transaction-card">
        <div class="admin-section-title">
            <h2>Produk Terlaris</h2>
            <p>Daftar 5 produk sepatu dengan jumlah penjualan tertinggi.</p>
        </div>

        <div class="chart-box product-chart-box">
            <canvas id="produkTerlarisChart"></canvas>

            <div
                id="produkChartData"
                data-labels='{{ $labelProdukTerlaris->toJson() }}'
                data-values='{{ $dataProdukTerlaris->toJson() }}'></div>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Total Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($produkTerlaris as $produk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>{{ $produk->nama_kategori }}</td>
                        <td>{{ $produk->total_terjual }}</td>
                        <td>Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-table">
                            Belum ada data produk terlaris.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="latest-transaction-card">
        <div class="admin-section-title">
            <h2>Ringkasan Penjualan</h2>
            <p>
                Ringkasan penjualan berdasarkan bulan, produk, kategori,
                jumlah terjual, dan pendapatan.
            </p>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Total Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($ringkasanPenjualan as $ringkasan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ringkasan->nama_bulan }}</td>
                        <td>{{ $ringkasan->tahun }}</td>
                        <td>{{ $ringkasan->nama_produk }}</td>
                        <td>{{ $ringkasan->nama_kategori }}</td>
                        <td>{{ $ringkasan->total_terjual }}</td>
                        <td>Rp {{ number_format($ringkasan->total_pendapatan, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty-table">
                            Belum ada data ringkasan penjualan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</section>


@endsection