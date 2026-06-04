<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan ShoeDW</title>

    <style>
        @include('laporan.pdf-style')
    </style>

</head>

<body>
    <div class="pdf-wrapper">
        <div class="pdf-header">
            <table class="pdf-header-table">
                <tr>
                    <td>
                        <h1 class="pdf-header-title">Laporan Penjualan ShoeDW</h1>
                        <p class="pdf-header-subtitle">
                            Laporan hasil analisis penjualan toko sepatu berdasarkan data warehouse
                            dan proses ETL transaksi berstatus Selesai.
                        </p>
                    </td>
                    <td style="width: 180px; text-align: right;">
                        <span class="pdf-badge">
                            {{ $periode }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>

        <table class="pdf-meta">
            <tr>
                <td>
                    <strong>Nama Sistem:</strong> ShoeDW - Sistem Data Warehouse Toko Sepatu
                </td>
                <td class="footer-right">
                    <strong>Tanggal Cetak:</strong> {{ now()->format('d M Y H:i') }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Sumber Data:</strong> Data Warehouse / Fact Penjualan
                </td>
                <td class="footer-right">
                    <strong>Status Data:</strong> Transaksi Selesai
                </td>
            </tr>
        </table>

        <table class="summary-table">
            <tr>
                <td class="summary-card summary-purple">
                    <span>Total Pendapatan</span>
                    <strong>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</strong>
                </td>

                <td class="summary-card summary-green">
                    <span>Total Transaksi</span>
                    <strong>{{ $totalTransaksi }}</strong>
                </td>

                <td class="summary-card summary-blue">
                    <span>Produk Terjual</span>
                    <strong>{{ $totalProdukTerjual }}</strong>
                </td>

                <td class="summary-card summary-orange">
                    <span>Rata-rata Transaksi</span>
                    <strong>Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>

        <div class="insight-box">
            <strong>Catatan Laporan:</strong>
            Laporan ini hanya menghitung transaksi dengan status <strong>Selesai</strong>.
            Transaksi Pending dan Kadaluarsa tidak masuk ke dalam perhitungan data warehouse,
            laporan penjualan, maupun ranking produk.
        </div>

        <h2 class="section-title">Produk Terlaris</h2>
        <p class="section-description">
            Tabel berikut menampilkan produk dengan jumlah penjualan tertinggi berdasarkan periode laporan yang dipilih.
        </p>

        @if ($dataPenjualan->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 45px;" class="text-center">No</th>
                    <th>Nama Produk</th>
                    <th style="width: 135px;">Kategori</th>
                    <th style="width: 100px;" class="text-center">Terjual</th>
                    <th style="width: 135px;" class="text-right">Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPenjualan as $item)
                <tr>
                    <td class="text-center">
                        <span class="rank-badge">{{ $loop->iteration }}</span>
                    </td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>
                        <span class="category-badge">
                            {{ $item->nama_kategori }}
                        </span>
                    </td>
                    <td class="text-center">
                        {{ $item->total_terjual }}
                    </td>
                    <td class="text-right">
                        Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-box">
            Belum ada data penjualan pada periode ini. Jalankan proses ETL setelah transaksi selesai tersedia.
        </div>
        @endif

        <h2 class="section-title">Kategori Terlaris</h2>
        <p class="section-description">
            Tabel berikut menampilkan kategori sepatu yang paling banyak terjual berdasarkan hasil akumulasi penjualan.
        </p>

        @if ($kategoriTerlaris->count() > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 45px;" class="text-center">No</th>
                    <th>Nama Kategori</th>
                    <th style="width: 120px;" class="text-center">Total Terjual</th>
                    <th style="width: 150px;" class="text-right">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategoriTerlaris as $kategori)
                <tr>
                    <td class="text-center">
                        <span class="rank-badge">{{ $loop->iteration }}</span>
                    </td>
                    <td>{{ $kategori['nama_kategori'] }}</td>
                    <td class="text-center">{{ $kategori['total_terjual'] }}</td>
                    <td class="text-right">
                        Rp {{ number_format($kategori['total_pendapatan'], 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-box">
            Belum ada data kategori terlaris pada periode ini.
        </div>
        @endif

        <div class="pdf-footer">
            <table class="footer-table">
                <tr>
                    <td>
                        <strong>ShoeDW</strong><br>
                        Sistem Data Warehouse Toko Sepatu Berbasis Web Menggunakan Laravel.
                    </td>
                    <td class="footer-right">
                        Laporan ini dihasilkan otomatis dari sistem.<br>
                        Data laporan mengikuti hasil ETL terakhir.
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>