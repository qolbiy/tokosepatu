<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $transaksi->kode_transaksi }}</title>

    <style>
        @page {
            margin: 35px 45px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #111;
            font-size: 12px;
            line-height: 1.5;
            background: #fff;
        }

        .invoice-wrapper {
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .store-name {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .store-info {
            font-size: 11px;
            color: #444;
        }

        .invoice-title {
            margin-top: 24px;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .status-stamp {
            position: absolute;
            top: 35px;
            right: 45px;
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #111;
            padding: 6px 14px;
            letter-spacing: 1px;
        }

        .meta-section {
            width: 100%;
            margin-bottom: 26px;
        }

        .meta-left,
        .meta-right {
            width: 48%;
            vertical-align: top;
        }

        .meta-left {
            float: left;
        }

        .meta-right {
            float: right;
        }

        .meta-box-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .meta-line {
            margin-bottom: 3px;
        }

        .clear {
            clear: both;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .item-table {
            margin-top: 18px;
            margin-bottom: 22px;
        }

        .item-table thead th {
            border-top: 1.5px solid #111;
            border-bottom: 1.5px solid #111;
            padding: 9px 6px;
            text-align: left;
            font-size: 12px;
        }

        .item-table tbody td {
            padding: 12px 6px;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .summary-wrapper {
            width: 100%;
            margin-top: 10px;
        }

        .payment-info {
            float: left;
            width: 45%;
            font-size: 11px;
        }

        .summary-table {
            float: right;
            width: 42%;
        }

        .summary-table td {
            padding: 4px 0;
        }

        .summary-table .grand-total td {
            border-top: 1.5px solid #111;
            padding-top: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        .status-note {
            margin-top: 8px;
            font-weight: bold;
            text-align: right;
        }

        .footer {
            margin-top: 90px;
            text-align: center;
            font-size: 11px;
            color: #555;
        }

        .small-note {
            margin-top: 8px;
            font-size: 10px;
            color: #555;
        }
    </style>
</head>

<body>

    <body>
        @php
        $statusLabel = match ($transaksi->status) {
        'Selesai' => 'LUNAS',
        'Pending' => 'MENUNGGU',
        'Kadaluarsa' => 'KADALUARSA',
        default => strtoupper($transaksi->status ?? '-'),
        };

        $sisaTagihan = $transaksi->status === 'Selesai' ? 0 : $transaksi->total_harga;
        $telahDibayar = $transaksi->status === 'Selesai' ? $transaksi->total_harga : 0;
        @endphp

        <div class="invoice-wrapper">

            <div class="status-stamp">{{ $statusLabel }}</div>

            <div class="header">
                <div class="store-name">SHOEDW</div>
                <div class="store-info">
                    Premium Shoes & Sneakers<br>
                    Email: shoedw@gmail.com | Telp: 0812-3456-7890
                </div>

                <div class="invoice-title">INVOICE</div>
            </div>

            <div class="meta-section">
                <div class="meta-left">
                    <div class="meta-box-title">Kepada:</div>
                    <div class="meta-line">{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</div>
                    <div class="meta-line">{{ $transaksi->pelanggan->email ?? '-' }}</div>
                    <div class="meta-line">{{ $transaksi->pelanggan->no_hp ?? '-' }}</div>
                    <div class="meta-line">{{ $transaksi->pelanggan->alamat ?? '-' }}</div>
                </div>

                <div class="meta-right">
                    <div class="meta-line">
                        <strong>No. Invoice:</strong>
                        INV-{{ $transaksi->kode_transaksi }}
                    </div>

                    <div class="meta-line">
                        <strong>Kode Transaksi:</strong>
                        {{ $transaksi->kode_transaksi }}
                    </div>

                    <div class="meta-line">
                        <strong>Tanggal Pesanan:</strong>
                        {{ $transaksi->confirmed_at ? \Carbon\Carbon::parse($transaksi->confirmed_at)->format('d M Y H:i') : '-' }}
                    </div>

                    <div class="meta-line">
                        <strong>Batas Bayar:</strong>
                        {{ $transaksi->payment_deadline ? \Carbon\Carbon::parse($transaksi->payment_deadline)->format('d M Y H:i') : '-' }}
                    </div>

                    <div class="meta-line">
                        <strong>Waktu Konfirmasi:</strong>
                        {{ $transaksi->confirmed_at ? \Carbon\Carbon::parse($transaksi->confirmed_at)->format('d M Y H:i') : '-' }}
                    </div>

                    <div class="meta-line">
                        <strong>Pembayaran:</strong>
                        {{ $transaksi->metode_pembayaran }}
                    </div>

                    <div class="meta-line">
                        <strong>Status:</strong>
                        {{ $transaksi->status }}
                    </div>
                </div>

                <div class="clear"></div>
            </div>

            <table class="item-table">
                <thead>
                    <tr>
                        <th>Deskripsi</th>
                        <th class="text-center">Ukuran</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Harga</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <strong>{{ $transaksi->detailTransaksi->produk->nama_produk ?? '-' }}</strong><br>
                            <span>
                                {{ $transaksi->detailTransaksi->produk->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>

                        <td class="text-center">
                            {{ $transaksi->detailTransaksi->ukuran ?? '-' }}
                        </td>

                        <td class="text-center">
                            {{ $transaksi->detailTransaksi->jumlah ?? 0 }}
                        </td>

                        <td class="text-right">
                            Rp {{ number_format($transaksi->detailTransaksi->harga_satuan ?? 0, 0, ',', '.') }}
                        </td>

                        <td class="text-right">
                            Rp {{ number_format($transaksi->detailTransaksi->subtotal ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="summary-wrapper">
                <div class="payment-info">
                    <strong>Info Pembayaran:</strong><br>

                    @if ($transaksi->metode_pembayaran === 'Transfer Bank')
                    Bank BCA 1234567890<br>
                    a.n. ShoeDW Ups Tegal
                    @elseif ($transaksi->metode_pembayaran === 'QRIS Simulasi')
                    QRIS Simulasi ShoeDW
                    @else
                    Pembayaran dilakukan dengan metode COD.
                    @endif

                    <div class="small-note">
                        @if ($transaksi->status === 'Selesai')
                        Invoice ini menunjukkan transaksi telah selesai dan pembayaran sudah dikonfirmasi.
                        @elseif ($transaksi->status === 'Pending')
                        Invoice ini masih bersifat sementara karena transaksi belum dikonfirmasi oleh admin.
                        @else
                        Invoice ini tidak berlaku sebagai bukti pembayaran karena transaksi telah kadaluarsa.
                        @endif
                    </div>
                </div>

                <table class="summary-table">
                    <tr>
                        <td>Subtotal</td>
                        <td class="text-right">
                            Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>

                    <tr class="grand-total">
                        <td>Total</td>
                        <td class="text-right">
                            Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>

                    <tr>
                        <td>Telah Dibayar</td>
                        <td class="text-right">
                            Rp {{ number_format($telahDibayar, 0, ',', '.') }}
                        </td>
                    </tr>

                    <tr>
                        <td>Sisa Tagihan</td>
                        <td class="text-right">
                            Rp {{ number_format($sisaTagihan, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>

                <div class="clear"></div>
            </div>

            <div class="footer">
                Terima kasih telah berbelanja di ShoeDW.
            </div>
        </div>
    </body>

</html>