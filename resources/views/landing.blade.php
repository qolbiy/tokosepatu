<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeDW - Data Warehouse Toko Sepatu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="navbar">
        <a href="#home" class="brand">
            <span class="brand-icon"></span>
            <span>Shoe<span>DW</span></span>
        </a>

        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="nav-menu" id="navMenu">
            <a href="#home">Beranda</a>
            <a href="#fitur">Fitur</a>
            <a href="#alur">Alur Sistem</a>
            <a href="#schema">Star Schema</a>
            <a href="#laporan">Laporan</a>
        </nav>

        @auth
        <a href="{{ route('dashboard') }}" class="nav-button">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="nav-button">Login Admin</a>
        @endauth
    </header>

    <main>
        <section id="home" class="hero-section">
            <div class="bubble bubble-one"></div>
            <div class="bubble bubble-two"></div>
            <div class="bubble bubble-three"></div>
            <div class="bubble bubble-four"></div>

            <div data-aos="fade-up">
                <div class="hero-content">
                    <span class="hero-badge">
                        Platform Data Warehouse Toko Sepatu
                    </span>

                    <h1>
                        Pantau Performa
                        <span>Toko Sepatu</span>
                        dengan Data Warehouse
                    </h1>

                    <p>
                        Sistem berbasis Laravel untuk mengelola data operasional,
                        menjalankan proses ETL, menerapkan Star Schema, dan menampilkan
                        laporan analisis dalam bentuk tabel serta grafik.
                    </p>

                    <div class="hero-actions">
                        <a href="#fitur" class="btn-primary">Mulai Jelajahi</a>
                        <a href="#schema" class="btn-secondary">Lihat Schema</a>
                    </div>

                    <div class="hero-stats">
                        <div class="hero-stat-item">
                            <strong>{{ $totalProduk }}</strong>
                            <span>Produk Sepatu</span>
                        </div>

                        <div class="hero-stat-item">
                            <strong>{{ $totalKategori }}</strong>
                            <span>Kategori</span>
                        </div>

                        <div class="hero-stat-item">
                            <strong>{{ $totalTransaksi }}</strong>
                            <span>Transaksi</span>
                        </div>

                        <div class="hero-stat-item">
                            <strong>Rp {{ number_format($totalPendapatan / 1000000, 1, ',', '.') }}Jt</strong>
                            <span>Pendapatan</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div data-aos="zoom-in">
                    <div class="dashboard-card product-preview-card">
                        <div class="card-header">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        @php
                        $fotoProdukTerlaris = !empty($produkTerlaris?->foto)
                        ? asset('storage/produk/' . $produkTerlaris->foto)
                        : asset('storage/produk/default-shoe.jpg');
                        @endphp

                        <div class="landing-product-image-box">
                            <img
                                src="{{ $fotoProdukTerlaris }}"
                                alt="{{ $produkTerlaris->nama_produk ?? 'Produk Terlaris' }}"
                                class="landing-product-image">
                        </div>

                        <div class="product-preview-content">
                            <span class="product-preview-badge">Produk Terlaris</span>

                            <h3>{{ $produkTerlaris->nama_produk ?? 'Belum ada produk terlaris' }}</h3>

                            <p>
                                Produk dari kategori {{ $produkTerlaris->nama_kategori ?? 'kategori belum tersedia' }}
                                ini mencatat penjualan tertinggi secara individual berdasarkan hasil data warehouse.
                            </p>

                            <div class="product-preview-stats">
                                <div class="product-preview-stat">
                                    <span>Total Terjual</span>
                                    <strong>{{ $produkTerlaris->total_terjual ?? 0 }} Produk</strong>
                                </div>

                                <div class="product-preview-stat">
                                    <span>Harga Jual</span>
                                    <strong>Rp {{ number_format($produkTerlaris->harga_jual ?? 0, 0, ',', '.') }}</strong>
                                </div>

                                <div class="product-preview-stat full">
                                    <span>Total Pendapatan</span>
                                    <strong>Rp {{ number_format($produkTerlaris->total_pendapatan ?? 0, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fitur" class="section">
            <div data-aos="fade-up">
                <div class="section-heading">
                    <span>Fitur Utama</span>
                    <h2>Fitur Website Data Warehouse</h2>
                    <p>
                        Website ini dirancang untuk mendukung proses pengelolaan data,
                        ETL, penyimpanan data warehouse, dan penyajian laporan analisis.
                    </p>
                </div>
            </div>

            <div class="feature-grid">
                <div data-aos="fade-up">
                    <div class="feature-card">
                        <div class="feature-code">DO</div>
                        <h3>Data Operasional</h3>
                        <p>
                            Mengelola data produk sepatu, kategori, pelanggan, transaksi,
                            dan detail transaksi sebagai sumber data utama.
                        </p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-code">TR</div>
                        <h3>Data Transaksi</h3>
                        <p>
                            Mencatat jumlah pembelian, harga produk, total pembayaran,
                            dan tanggal transaksi penjualan sepatu.
                        </p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-code">ETL</div>
                        <h3>Proses ETL</h3>
                        <p>
                            Mengambil, membersihkan, mengubah, dan memindahkan data
                            operasional ke dalam data warehouse.
                        </p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-code">DW</div>
                        <h3>Data Warehouse</h3>
                        <p>
                            Menyimpan data hasil ETL ke dalam tabel dimensi dan tabel fakta
                            agar siap digunakan untuk analisis.
                        </p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-code">SC</div>
                        <h3>Star Schema</h3>
                        <p>
                            Menerapkan fact penjualan sebagai pusat analisis yang terhubung
                            dengan tabel dimensi.
                        </p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-code">RP</div>
                        <h3>Laporan Analisis</h3>
                        <p>
                            Menampilkan laporan produk terlaris, kategori terlaris,
                            pendapatan, dan penjualan bulanan.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="alur" class="section flow-section">
            <div data-aos="fade-up">
                <div class="section-heading">
                    <span>Alur Sistem</span>
                    <h2>Alur Kerja Sistem</h2>
                    <p>
                        Proses sistem dimulai dari input data operasional sampai menjadi
                        laporan analisis yang siap digunakan untuk pemantauan toko.
                    </p>
                </div>
            </div>

            <div class="flow-grid">
                <div data-aos="fade-up">
                    <div class="flow-card">
                        <span>01</span>
                        <h3>Input Data</h3>
                        <p>Admin mengelola data produk, kategori, pelanggan, dan transaksi.</p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="flow-card">
                        <span>02</span>
                        <h3>Proses ETL</h3>
                        <p>Sistem melakukan extract, transform, dan load data operasional.</p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="flow-card">
                        <span>03</span>
                        <h3>Data Warehouse</h3>
                        <p>Data disimpan ke tabel dimensi dan fakta menggunakan Star Schema.</p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="flow-card">
                        <span>04</span>
                        <h3>Analisis Data</h3>
                        <p>Data dianalisis berdasarkan waktu, produk, kategori, dan pelanggan.</p>
                    </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="400">
                    <div class="flow-card">
                        <span>05</span>
                        <h3>Laporan</h3>
                        <p>Hasil analisis ditampilkan dalam tabel dan grafik interaktif.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="schema" class="section">
            <div data-aos="fade-up">
                <div class="section-heading">
                    <span>Star Schema</span>
                    <h2>Model Data Warehouse</h2>
                    <p>
                        Fact penjualan menjadi pusat data yang terhubung dengan beberapa
                        tabel dimensi untuk memudahkan proses analisis.
                    </p>
                </div>
            </div>

            <div data-aos="zoom-in">
                <div class="schema-wrapper">
                    <div class="schema-dim">dim_produk</div>
                    <div class="schema-dim">dim_pelanggan</div>
                    <div class="schema-fact">
                        fact_penjualan
                        <small>qty, harga, total, pendapatan</small>
                    </div>
                    <div class="schema-dim">dim_waktu</div>
                    <div class="schema-dim">dim_kategori</div>
                </div>
            </div>
        </section>

        <section id="laporan" class="section">
            <div data-aos="fade-up">
                <div class="section-heading">
                    <span>Laporan Analisis</span>
                    <h2>Monitoring Performa Toko</h2>
                    <p>
                        Laporan divisualisasikan menggunakan Chart.js agar performa toko
                        mudah dipantau melalui grafik dan tabel.
                    </p>
                </div>
            </div>

            <div class="report-grid">
                <div data-aos="fade-right">
                    <div class="report-card">
                        <h3>Penjualan Bulanan</h3>
                        <p class="report-desc">
                            Grafik pendapatan penjualan berdasarkan bulan dari hasil data warehouse.
                        </p>

                        <div class="chart-box">
                            <canvas id="salesChart"></canvas>

                            <div
                                id="landingSalesChartData"
                                data-labels='{{ $labelPendapatanLanding->toJson() }}'
                                data-values='{{ $dataPendapatanLanding->toJson() }}'></div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left">
                    <div class="report-card">
                        <h3>Kategori Terlaris</h3>
                        <p class="report-desc">
                            Grafik kategori sepatu dengan jumlah penjualan tertinggi.
                        </p>

                        <div class="chart-box">
                            <canvas id="categoryChart"></canvas>

                            <div
                                id="landingCategoryChartData"
                                data-labels='{{ $labelKategoriLanding->toJson() }}'
                                data-values='{{ $dataKategoriLanding->toJson() }}'></div>
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-up">
                <div class="table-card popular-product-card">
                    <div class="popular-product-header">
                        <div>
                            <span>Produk Terlaris</span>
                            <h3>Produk dengan Penjualan Tertinggi</h3>
                            <p>
                                Data produk terlaris diambil dari hasil proses ETL pada data warehouse.
                            </p>
                        </div>

                        <a href="{{ route('laporan.index') }}" class="table-card-link">
                            Lihat Laporan
                        </a>
                    </div>

                    <div class="popular-product-chart">
                        <canvas id="landingPopularProductChart"></canvas>

                        <div
                            id="landingPopularProductChartData"
                            data-labels='{{ $labelProdukTerlarisLanding->toJson() }}'
                            data-values='{{ $dataProdukTerlarisLanding->toJson() }}'></div>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Ranking</th>
                                    <th>Foto</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Total Terjual</th>
                                    <th>Total Pendapatan</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($produkTerlarisLanding as $produk)
                                <tr>
                                    <td>
                                        <span class="rank-badge">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>

                                    <td>
                                        @php
                                        $fotoProduk = !empty($produk->foto)
                                        ? asset('storage/produk/' . $produk->foto)
                                        : asset('storage/produk/default-shoe.jpg');
                                        @endphp

                                        <img
                                            src="{{ $fotoProduk }}"
                                            alt="{{ $produk->nama_produk }}"
                                            class="landing-table-product-img">
                                    </td>

                                    <td>
                                        <strong class="product-name">
                                            {{ $produk->nama_produk }}
                                        </strong>
                                    </td>

                                    <td>
                                        <span class="category-pill">
                                            {{ $produk->nama_kategori }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $produk->total_terjual }} Produk
                                    </td>

                                    <td>
                                        Rp {{ number_format($produk->total_pendapatan, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="empty-table">
                                        Belum ada data produk terlaris. Jalankan proses ETL terlebih dahulu.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <div>
                <h2>ShoeDW</h2>
                <p>
                    Sistem Data Warehouse Toko Sepatu untuk membantu pemantauan
                    data penjualan, produk, pelanggan, dan laporan analisis toko.
                </p>
            </div>

            <div>
                <h3>Menu</h3>
                <a href="#home">Beranda</a>
                <a href="#fitur">Fitur</a>
                <a href="#alur">Alur Sistem</a>
                <a href="#schema">Star Schema</a>
                <a href="#laporan">Laporan</a>
            </div>

            <div>
                <h3>Teknologi</h3>
                <a href="javascript:void(0)">Laravel</a>
                <a href="javascript:void(0)">Vite</a>
                <a href="javascript:void(0)">Chart.js</a>
                <a href="javascript:void(0)">AOS Animation</a>
                <a href="javascript:void(0)">MySQL</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 ShoeDW. Sistem Data Warehouse Toko Sepatu.</p>
        </div>
    </footer>
</body>

</html>