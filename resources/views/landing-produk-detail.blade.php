<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - ShoeDW</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="product-detail-page">
        <div class="product-detail-container">
            <!--
            <div class="product-detail-nav">
                <a href="{{ route('landing') }}#produk" class="back-to-product">
                    Kembali ke Produk
                </a>
            </div>
            -->

            <div class="product-detail-card">
                @php
                    $fotoProduk = !empty($produk->foto)
                        ? asset('storage/produk/' . $produk->foto)
                        : asset('storage/produk/default-shoe.jpg');
                @endphp

                <div class="product-detail-image">
                    <img
                        src="{{ $fotoProduk }}"
                        alt="{{ $produk->nama_produk }}">
                </div>

                <div class="product-detail-content">
                    <span class="product-detail-category">
                        {{ $produk->kategori->nama_kategori ?? 'Kategori Produk' }}
                    </span>

                    <h1>{{ $produk->nama_produk }}</h1>

                    <p class="product-detail-description">
                        {{ $produk->deskripsi ?? 'Produk sepatu ini tersedia di sistem ShoeDW dengan informasi kategori, merek, ukuran, warna, stok, dan harga yang dapat dilihat secara lengkap.' }}
                    </p>

                    <div class="product-detail-price">
                        Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                    </div>

                    <div class="product-detail-grid">
                        <div class="product-detail-item">
                            <span>Merek</span>
                            <strong>{{ $produk->merek ?? '-' }}</strong>
                        </div>

                        <div class="product-detail-item">
                            <span>Kategori</span>
                            <strong>{{ $produk->kategori->nama_kategori ?? '-' }}</strong>
                        </div>

                        <div class="product-detail-item">
                            <span>Ukuran</span>
                            <strong>{{ $produk->ukuran ?? '-' }}</strong>
                        </div>

                        <div class="product-detail-item">
                            <span>Warna</span>
                            <strong>{{ $produk->warna ?? '-' }}</strong>
                        </div>

                        <div class="product-detail-item">
                            <span>Stok</span>
                            <strong>
                                @if ($produk->stok > 0)
                                    {{ $produk->stok }} Produk
                                @else
                                    Stok Habis
                                @endif
                            </strong>
                        </div>

                        <div class="product-detail-item">
                            <span>Status</span>
                            <strong>
                                @if ($produk->stok > 0)
                                    Tersedia
                                @else
                                    Tidak Tersedia
                                @endif
                            </strong>
                        </div>
                    </div>

                    <div class="product-detail-actions">
                        @if ($produk->stok > 0)
                            <a href="javascript:void(0)" class="btn-detail-buy">
                                Beli Sekarang
                            </a>
                        @else
                            <a href="javascript:void(0)" class="btn-detail-disabled">
                                Stok Habis
                            </a>
                        @endif

                       <a 
    href="{{ route('landing') }}#produk" 
    class="btn-product-detail"
    id="backToProductSection"
>
    Lihat Produk Lain
</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>