<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShoeDW - Data Warehouse Toko Sepatu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
</head>

<body>
    <!--
    <div id="landingPreloader" class="landing-preloader">
        <div class="preloader-simple-content">
            <img
                src="{{ asset('images/logo/logo-shoedw.png') }}"
                alt="ShoeDW Logo"
                class="preloader-logo-img">

            <div class="preloader-simple-bar">
                <div class="preloader-simple-fill"></div>
            </div>

            <p>Loading<span>.</span><span>.</span><span>.</span></p>
        </div>
    </div>
    -->

    <header class="navbar">
        <a href="#home" class="brand">
            <img
                src="{{ asset('images/logo/logo-shoedw.png') }}"
                alt="ShoeDW Logo"
                class="brand-logo-img">
        </a>

        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="nav-menu" id="navMenu">
            <a href="#home">Beranda</a>
            <a href="#produk">Produk</a>
            <a href="#ranking">Ranking</a>
            <a href="#testimoni">Testimoni</a>

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
                        Toko Sepatu Online Berbasis Web
                    </span>

                    <h1>
                        Temukan Sepatu
                        <span>Favoritmu</span>
                        dengan Mudah
                    </h1>

                    <p>
                        ShoeDW menghadirkan berbagai pilihan sepatu dengan informasi produk
                        yang jelas, stok yang mudah dilihat, serta proses pembelian yang praktis
                        melalui halaman katalog online.
                    </p>

                    <div class="hero-actions">
                        <a href="#produk" class="btn-primary">Lihat Produk</a>
                        <a href="#ranking" class="btn-secondary">Produk Terlaris</a>
                    </div>

                    <div class="hero-stats">
                        <div class="hero-stat-item">
                            <strong
                                class="counter-number"
                                data-target="{{ $totalProduk }}"
                                data-format="number">0</strong>
                            <span>Produk Sepatu</span>
                        </div>

                        <div class="hero-stat-item">
                            <strong
                                class="counter-number"
                                data-target="{{ $totalKategori }}"
                                data-format="number">0</strong>
                            <span>Kategori</span>
                        </div>

                        <div class="hero-stat-item">
                            <strong
                                class="counter-number"
                                data-target="{{ $totalTransaksi }}"
                                data-format="number">0</strong>
                            <span>Transaksi</span>
                        </div>

                        <div class="hero-stat-item">
                            <strong
                                class="counter-number"
                                data-target="{{ $totalPendapatan / 1000000 }}"
                                data-format="currency-million">Rp 0Jt</strong>
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
                                class="landing-product-image"
                                loading="lazy">
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
                                    <strong>
                                        Rp {{ number_format($produkTerlaris->harga_jual ?? 0, 0, ',', '.') }}
                                    </strong>
                                </div>

                                <div class="product-preview-stat full">
                                    <span>Total Pendapatan</span>
                                    <strong>
                                        Rp {{ number_format($produkTerlaris->total_pendapatan ?? 0, 0, ',', '.') }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="produk" class="section product-shop-section">
            <div data-aos="fade-up">
                <div class="section-heading">
                    <span>Produk</span>
                    <h2>Produk Sepatu Pilihan</h2>
                    <p>
                        Temukan sepatu sesuai kebutuhan dengan pilihan kategori, merek,
                        warna, harga, dan informasi stok yang tersedia secara langsung.
                    </p>
                </div>
            </div>

            {{-- Filter Produk Landing --}}
            <div class="product-filter-bar" data-aos="fade-up">
                <form action="{{ route('landing') }}#produk" method="GET" class="product-filter-form" id="productFilterForm">
                    <div class="product-filter-item">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori">
                            <option value="">Semua Kategori</option>

                            @foreach ($kategoriFilterLanding as $kategori)
                            <option
                                value="{{ $kategori->id }}"
                                {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="product-filter-item">
                        <label for="merek">Merek</label>
                        <select name="merek" id="merek">
                            <option value="">Semua Merek</option>

                            @foreach ($merekFilterLanding as $itemMerek)
                            <option
                                value="{{ $itemMerek }}"
                                {{ request('merek') == $itemMerek ? 'selected' : '' }}>
                                {{ $itemMerek }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="product-filter-action">
                        <button type="submit" class="btn-filter-apply">
                            Terapkan
                        </button>

                        <a
                            href="{{ route('landing') }}#produk"
                            class="btn-filter-reset"
                            id="productFilterReset">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="shop-product-grid">
                @forelse ($produkLanding as $produk)
                @php
                $fotoProduk = !empty($produk->foto)
                ? asset('storage/produk/' . $produk->foto)
                : asset('storage/produk/default-shoe.jpg');
                @endphp

                <div
                    class="shop-product-card {{ $loop->index >= 8 ? 'product-hidden' : '' }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ ($loop->index % 8) * 80 }}">

                    <div class="shop-product-image">
                        <img
                            src="{{ $fotoProduk }}"
                            alt="{{ $produk->nama_produk }}"
                            loading="lazy">
                    </div>

                    <div class="shop-product-content">
                        <span class="shop-product-category">
                            {{ $produk->kategori->nama_kategori ?? 'Kategori' }}
                        </span>

                        <h3>{{ $produk->nama_produk }}</h3>

                        <p>
                            {{ $produk->merek ?? 'Merek tidak tersedia' }} •
                            {{ $produk->warna ?? 'Warna tidak tersedia' }}
                        </p>

                        <div class="shop-product-meta">
                            <strong>
                                Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                            </strong>

                            @if ($produk->stok <= 0)
                                <span class="stock-badge danger">Habis</span>
                                @elseif ($produk->stok <= 5)
                                    <span class="stock-badge warning">{{ $produk->stok }} tersisa</span>
                                    @else
                                    <span class="stock-badge success">Stok {{ $produk->stok }}</span>
                                    @endif
                        </div>

                        <div class="shop-product-actions">
                            <a href="{{ route('landing.produk.show', $produk->id) }}" class="btn-product-detail">
                                Detail
                            </a>

                            @if ($produk->stok > 0)
                            <button
                                type="button"
                                class="btn-product-buy js-checkout-button"
                                data-id="{{ $produk->id }}"
                                data-nama="{{ $produk->nama_produk }}"
                                data-merek="{{ $produk->merek ?? 'Merek tidak tersedia' }}"
                                data-harga="{{ $produk->harga_jual }}"
                                data-stok="{{ $produk->stok }}"
                                data-foto="{{ $fotoProduk }}">
                                Beli Sekarang
                            </button>
                            @else
                            <button type="button" class="btn-product-disabled" disabled>
                                Stok Habis
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-product-message">
                    <h3>Produk tidak ditemukan</h3>
                    <p>
                        Coba gunakan kategori atau merek lain untuk menampilkan produk yang sesuai.
                    </p>
                </div>
                @endforelse
            </div>

            @if ($produkLanding->count() > 8)
            <div class="product-toggle-wrapper">
                <button type="button" class="product-toggle-button" id="productToggleButton">
                    Lihat Semua Produk
                </button>
            </div>
            @endif
        </section>

        {{-- Modal Checkout Produk --}}
        <div class="checkout-modal" id="checkoutModal" aria-hidden="true">
            <div class="checkout-modal-overlay"></div>

            <div class="checkout-modal-box">
                <button type="button" class="checkout-modal-close" id="checkoutModalClose">
                    ×
                </button>

                <div class="checkout-modal-header">
                    <span>Checkout Produk</span>
                    <h3>Konfirmasi Pembelian</h3>
                    <p>
                        Isi data pembelian dengan benar sebelum melanjutkan proses checkout.
                    </p>
                </div>

                <div class="checkout-product-preview">
                    <div class="checkout-product-image">
                        <img
                            src="{{ asset('storage/produk/default-shoe.jpg') }}"
                            alt="Preview Produk"
                            id="checkoutProductImage">
                    </div>

                    <div class="checkout-product-info">
                        <h4 id="checkoutProductName">Nama Produk</h4>
                        <p id="checkoutProductBrand">Merek Produk</p>
                        <strong id="checkoutProductPrice">Rp 0</strong>
                        <span id="checkoutProductStock">Stok 0</span>
                    </div>
                </div>

                <form
                    class="checkout-form"
                    id="checkoutForm"
                    action="{{ route('landing.checkout.simpan') }}"
                    method="POST">
                    @csrf

                    <input type="hidden" name="produk_id" id="checkoutProductId">

                    <div class="checkout-form-group">
                        <label for="checkoutCustomerName">Nama Pembeli</label>
                        <input
                            type="text"
                            name="nama_pelanggan"
                            id="checkoutCustomerName"
                            placeholder="Masukkan nama pembeli"
                            autocomplete="name">
                    </div>

                    <div class="checkout-form-group">
                        <label for="checkoutCustomerEmail">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="checkoutCustomerEmail"
                            placeholder="Contoh: pelanggan@email.com"
                            autocomplete="email">
                    </div>

                    <div class="checkout-form-group">
                        <label for="checkoutCustomerPhone">Nomor WhatsApp</label>
                        <input
                            type="text"
                            name="no_hp"
                            id="checkoutCustomerPhone"
                            placeholder="Contoh: 081234567890"
                            autocomplete="tel">
                    </div>

                    <div class="checkout-form-group">
                        <label for="checkoutCustomerGender">Jenis Kelamin</label>
                        <select
                            name="jenis_kelamin"
                            id="checkoutCustomerGender"
                            autocomplete="sex">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="checkout-form-group">
                        <label for="checkoutCustomerAddress">Alamat</label>
                        <textarea
                            name="alamat"
                            id="checkoutCustomerAddress"
                            rows="3"
                            placeholder="Masukkan alamat pembeli"
                            autocomplete="street-address"></textarea>
                    </div>

                    <div class="checkout-form-row">
                        <div class="checkout-form-group">
                            <label for="checkoutQuantity">Jumlah</label>
                            <input
                                type="number"
                                name="jumlah"
                                id="checkoutQuantity"
                                value="1"
                                min="1">
                        </div>

                        <div class="checkout-form-group">
                            <label for="checkoutPayment">Metode Pembayaran</label>
                            <select name="metode_pembayaran" id="checkoutPayment">
                                <option value="COD">COD - Bayar di Tempat</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="QRIS Simulasi">QRIS Simulasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="checkout-payment-info" id="checkoutPaymentInfo">
                        <div class="payment-info-item active" data-payment-info="COD">
                            <div class="payment-info-header">
                                <span>COD</span>
                                <strong>Bayar di Tempat</strong>
                            </div>

                            <p>
                                Pembayaran dilakukan secara langsung saat produk diterima oleh pembeli.
                                Pesanan dengan metode COD akan langsung diproses sebagai transaksi selesai.
                            </p>
                        </div>

                        <div class="payment-info-item" data-payment-info="Transfer Bank">
                            <div class="payment-info-header">
                                <span>Transfer</span>
                                <strong>Transfer Bank</strong>
                            </div>

                            <p>
                                Pembayaran dilakukan melalui transfer bank. Setelah pesanan dibuat,
                                transaksi akan menunggu konfirmasi admin sebelum diproses lebih lanjut.
                            </p>

                            <div class="bank-info-box">
                                <span>Rekening Tujuan</span>
                                <strong>BCA 1234567890</strong>
                                <small>a.n. ShoeDW Ups Tegal</small>
                            </div>
                        </div>

                        <div class="payment-info-item" data-payment-info="QRIS Simulasi">
                            <div class="payment-info-header">
                                <span>QRIS</span>
                                <strong>QRIS Simulasi</strong>
                            </div>

                            <p>
                                Pembayaran menggunakan QRIS simulasi. Setelah checkout dilakukan,
                                transaksi akan menunggu konfirmasi admin terlebih dahulu.
                            </p>

                            <div class="qris-preview-box">
                                <img
                                    src="{{ asset('images/payment/qris-shoedw.jpeg') }}"
                                    alt="QRIS ShoeDW"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">

                                <small style="display: none;">
                                    Gambar QRIS belum tersedia. Simpan QRIS di public/images/payment/qris-shoedw.jpeg
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-total-box">
                        <span>Total Pembayaran</span>
                        <strong id="checkoutTotalPrice">Rp 0</strong>
                    </div>

                    <button type="button" class="checkout-submit-button" id="checkoutSubmitButton">
                        Lanjutkan Pembelian
                    </button>
                </form>
            </div>
        </div>

        <section id="ranking" class="section ranking-section">
            <div data-aos="fade-up">
                <div class="section-heading">
                    <span>Ranking Penjualan</span>
                    <h2>Produk dengan Penjualan Tertinggi</h2>
                    <p>
                        Lihat daftar produk sepatu yang paling banyak dibeli pelanggan
                        berdasarkan data penjualan yang telah diproses oleh sistem.
                    </p>
                </div>
            </div>

            <div class="ranking-wrapper" data-aos="fade-up">
                <div class="ranking-header">
                    <div>
                        <h3>Top Produk Terlaris</h3>
                        <p>
                            Daftar ini membantu pembeli mengetahui produk sepatu yang paling
                            diminati dan sering terjual.
                        </p>
                    </div>
                </div>

                <div class="ranking-list">
                    @forelse ($produkTerlarisLanding as $produkRanking)
                    @php
                    $fotoProdukRanking = !empty($produkRanking->foto)
                    ? asset('storage/produk/' . $produkRanking->foto)
                    : asset('storage/produk/default-shoe.jpg');
                    @endphp

                    <div class="ranking-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="ranking-number">
                            {{ $loop->iteration }}
                        </div>

                        <div class="ranking-image">
                            <img
                                src="{{ $fotoProdukRanking }}"
                                alt="{{ $produkRanking->nama_produk }}"
                                loading="lazy">
                        </div>

                        <div class="ranking-info">
                            <h4>{{ $produkRanking->nama_produk }}</h4>
                            <span>{{ $produkRanking->nama_kategori }}</span>
                        </div>

                        <div class="ranking-sales">
                            <span>Total Terjual</span>
                            <strong>{{ $produkRanking->total_terjual }} Produk</strong>
                        </div>

                        <div class="ranking-income">
                            <span>Total Pendapatan</span>
                            <strong>
                                Rp {{ number_format($produkRanking->total_pendapatan, 0, ',', '.') }}
                            </strong>
                        </div>
                    </div>
                    @empty
                    <div class="empty-product-message">
                        Belum ada data ranking penjualan. Jalankan proses ETL terlebih dahulu.
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    {{-- Section Testimoni --}}
    <section id="testimoni" class="section testimonial-section">
        <div data-aos="fade-up">
            <div class="section-heading">
                <span>Testimoni</span>
                <h2>Apa Kata Pelanggan ShoeDW</h2>
                <p>
                    Ulasan dari pelanggan yang telah melakukan pembelian sepatu
                    melalui sistem ShoeDW.
                </p>
            </div>
        </div>

        @php
        $reviewPelanggan = [
        'Proses pembelian sepatu di ShoeDW sangat mudah, tampilan produknya jelas, dan stok barang terlihat informatif.',
        'Saya terbantu dengan fitur produk terlaris karena bisa melihat sepatu yang paling banyak diminati pelanggan lain.',
        'Pilihan produknya rapi, informasi harga mudah dipahami, dan proses checkout berjalan praktis.',
        'Metode pembayaran yang tersedia cukup jelas, mulai dari COD, Transfer Bank, sampai QRIS Simulasi.',
        'Tampilan websitenya nyaman digunakan, terutama saat mencari sepatu berdasarkan kategori dan merek.',
        'Detail produk membantu saya melihat informasi sepatu sebelum melakukan pembelian.',
        'ShoeDW memudahkan pembeli untuk memilih sepatu tanpa harus bingung melihat stok dan harga.',
        'Proses transaksi terasa sederhana dan cocok digunakan untuk sistem toko sepatu berbasis web.',
        ];
        @endphp

        <div class="testimonial-marquee" data-aos="fade-up">
            <div class="testimonial-track">
                @forelse ($testimoniPelanggan as $pelanggan)
                @php
                $review = $reviewPelanggan[$loop->index % count($reviewPelanggan)];
                @endphp

                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        ★★★★★
                    </div>

                    <p>
                        “{{ $review }}”
                    </p>

                    <h4>{{ $pelanggan->nama_pelanggan }}</h4>
                    <span>{{ $pelanggan->alamat ?? 'Pelanggan ShoeDW' }}</span>
                </div>
                @empty
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        ★★★★★
                    </div>

                    <p>
                        “Belum ada data pelanggan. Testimoni akan tampil setelah
                        pelanggan melakukan pembelian melalui sistem.”
                    </p>

                    <h4>Pelanggan ShoeDW</h4>
                    <span>Data belum tersedia</span>
                </div>
                @endforelse

                {{-- Duplikasi agar animasi berjalan mulus --}}
                @foreach ($testimoniPelanggan as $pelanggan)
                @php
                $review = $reviewPelanggan[$loop->index % count($reviewPelanggan)];
                @endphp

                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        ★★★★★
                    </div>

                    <p>
                        “{{ $review }}”
                    </p>

                    <h4>{{ $pelanggan->nama_pelanggan }}</h4>
                    <span>{{ $pelanggan->alamat ?? 'Pelanggan ShoeDW' }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="teknologi" class="tech-section" data-aos="fade-up">
        <div class="section-heading" data-aos="fade-up">
            <span>Teknologi</span>
            <h2>Teknologi yang Digunakan</h2>
            <p>
                ShoeDW dikembangkan menggunakan teknologi web modern untuk mendukung
                katalog produk, transaksi pembelian, pengelolaan data, dan laporan sistem.
            </p>
        </div>

        <div class="tech-marquee" id="techMarquee">
            <div class="tech-track" id="techTrack">
                @for ($i = 0; $i < 3; $i++)
                    <div class="tech-item">
                    <i class="devicon-laravel-plain colored"></i>
                    <span>Laravel</span>
            </div>

            <div class="tech-item">
                <i class="devicon-php-plain colored"></i>
                <span>PHP</span>
            </div>

            <div class="tech-item">
                <i class="devicon-mysql-plain colored"></i>
                <span>MySQL</span>
            </div>

            <div class="tech-item">
                <i class="devicon-javascript-plain colored"></i>
                <span>JavaScript</span>
            </div>

            <div class="tech-item">
                <i class="devicon-vitejs-plain colored"></i>
                <span>Vite</span>
            </div>

            <div class="tech-item">
                <i class="devicon-tailwindcss-plain colored"></i>
                <span>Tailwind</span>
            </div>

            <div class="tech-item">
                <i class="devicon-laravel-plain colored"></i>
                <span>Blade</span>
            </div>

            <div class="tech-item">
                <span class="tech-text-icon">AOS</span>
                <span>AOS</span>
            </div>
            @endfor
        </div>
        </div>

        <p class="tech-hint" data-aos="fade-up" data-aos-delay="250">
            Gerakkan cursor ke kiri atau kanan untuk mengubah arah animasi.
        </p>
    </section>

    <footer class="footer">
        <div class="footer-inner">
            <div>
                <h2>ShoeDW</h2>
                <p>
                    ShoeDW adalah sistem toko sepatu berbasis web yang membantu pembeli
                    melihat produk, melakukan checkout, dan mengetahui produk terlaris
                    dengan tampilan yang mudah digunakan.
                </p>
            </div>

            <div>
                <h3>Menu</h3>
                <a href="#home">Beranda</a>
                <a href="#produk">Produk</a>
                <a href="#ranking">Ranking</a>
                <a href="#testimoni">Testimoni</a>

            </div>

            <div>
                <h3>Layanan</h3>
                <a href="#produk">Katalog Produk</a>
                <a href="#ranking">Produk Terlaris</a>
                <a href="#produk">Cek Stok Sepatu</a>
                <a href="#produk">Informasi Harga</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 ShoeDW. Sistem Data Warehouse Toko Sepatu.</p>
        </div>
    </footer>
    <div
        id="checkoutSessionAlert"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}">
    </div>
</body>

</html>