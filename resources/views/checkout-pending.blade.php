<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Pembayaran - ShoeDW</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main class="payment-waiting-page">
        <section class="payment-waiting-card">
            @php
            $isCod = $transaksi->metode_pembayaran === 'COD';
            $isSelesai = $transaksi->status === 'Selesai';
            $isKadaluarsa = $transaksi->status === 'Kadaluarsa';
            @endphp
            <div class="payment-waiting-header">
                <span>
                    {{ $transaksi->status === 'Selesai' ? 'Pembayaran Lunas' : 'Menunggu Pembayaran' }}
                </span>

                <h1>
                    {{ $transaksi->status === 'Selesai' ? 'Pesanan Berhasil Dibayar' : 'Pesanan Berhasil Dibuat' }}
                </h1>

                <p>
                    @if ($transaksi->status === 'Selesai')
                    Pembayaran telah selesai. Anda dapat melihat atau mengunduh invoice transaksi.
                    @else
                    Silakan lakukan pembayaran sebelum batas waktu habis.
                    Setelah pembayaran dianggap valid, admin akan mengonfirmasi transaksi.
                    @endif
                </p>
            </div>

            <div class="payment-order-summary">
                <div>
                    <span>Kode Transaksi</span>
                    <strong>{{ $transaksi->kode_transaksi }}</strong>
                </div>

                <div>
                    <span>Nama Pembeli</span>
                    <strong>{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</strong>
                </div>

                <div>
                    <span>Produk</span>
                    <strong>{{ $transaksi->detailTransaksi->produk->nama_produk ?? '-' }}</strong>
                </div>

                <div>
                    <span>Ukuran</span>
                    <strong>{{ $transaksi->detailTransaksi->ukuran ?? '-' }}</strong>
                </div>

                <div>
                    <span>Jumlah</span>
                    <strong>{{ $transaksi->detailTransaksi->jumlah ?? 0 }} Produk</strong>
                </div>

                <div>
                    <span>Total Pembayaran</span>
                    <strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong>
                </div>

                <div>
                    <span>Metode Pembayaran</span>
                    <strong>{{ $transaksi->metode_pembayaran }}</strong>
                </div>

                <div>
                    <span>Status</span>
                    <strong
                        id="paymentStatusText"
                        class="{{ $transaksi->status === 'Selesai' ? 'payment-status-success' : 'payment-status-pending' }}">
                        {{ $transaksi->status }}
                    </strong>
                </div>
            </div>

        <div
    class="payment-countdown-box"
    data-deadline="{{ $transaksi->payment_deadline ? \Carbon\Carbon::parse($transaksi->payment_deadline)->toIso8601String() : '' }}"
    data-status-url="{{ route('checkout.status', $transaksi->id) }}"
    data-expired-url="{{ route('checkout.expired', $transaksi->id) }}"
    data-current-status="{{ $transaksi->status }}">
    
    <span>
        {{ $isCod ? 'Status Pesanan COD' : 'Sisa Waktu Pembayaran' }}
    </span>

    <strong id="paymentCountdown">
        @if ($isSelesai)
            Lunas
        @elseif ($isCod)
            Menunggu
        @else
            10:00
        @endif
    </strong>

    <p>
        @if ($isSelesai)
            Pesanan sudah dikonfirmasi oleh admin dan invoice sudah tersedia.
        @elseif ($isCod)
            Pesanan COD tidak menggunakan batas waktu pembayaran. Silakan menunggu konfirmasi dari admin.
        @else
            Jika melewati batas waktu, transaksi akan menjadi Kadaluarsa
            dan perlu membuat pesanan ulang.
        @endif
    </p>
</div>

            @if ($transaksi->metode_pembayaran === 'Transfer Bank')
            <div class="payment-instruction-box">
                <span>Transfer Bank</span>
                <h2>BCA 1234567890</h2>
                <p>a.n. ShoeDW Ups Tegal</p>
                <small>
                    Transfer sesuai total pembayaran agar admin dapat memvalidasi transaksi.
                </small>
            </div>
            @elseif ($transaksi->metode_pembayaran === 'QRIS Simulasi')
            <div class="payment-instruction-box">
                <span>QRIS Simulasi</span>
                <h2>Scan QRIS</h2>

                <div class="payment-qris-box">
                    <img
                        src="{{ asset('images/payment/qris-shoedw.jpeg') }}"
                        alt="QRIS ShoeDW"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">

                    <small style="display: none;">
                        Gambar QRIS belum tersedia. Simpan QRIS di public/images/payment/qris-shoedw.jpeg
                    </small>
                </div>

                <small>
                    Scan QRIS simulasi sesuai total pembayaran agar transaksi dapat dikonfirmasi admin.
                </small>
            </div>
            @endif

            <div class="payment-waiting-actions">

                <div
                    id="invoiceActionBox"
                    class="invoice-action-box {{ $transaksi->status === 'Selesai' ? '' : 'invoice-hidden' }}">

                    <a
                        href="{{ route('invoice.lihat', $transaksi->id) }}"
                        target="_blank"
                        class="payment-invoice-button">
                        Lihat Invoice
                    </a>

                    <a
                        href="{{ route('invoice.download', $transaksi->id) }}"
                        class="payment-invoice-download-button">
                        Download Invoice
                    </a>
                </div>

                <a href="{{ route('landing') }}#produk" class="payment-back-button">
                    Kembali ke Produk
                </a>

                <a href="{{ route('landing') }}" class="payment-home-button">
                    Ke Beranda
                </a>
            </div>
        </section>
    </main>
</body>

</html>