@extends('layouts.admin')

@section('title', 'Data Transaksi - ShoeDW')
@section('page-title', 'Data Transaksi')
@section('page-subtitle', 'Kelola transaksi penjualan sepatu.')

@section('content')
<section class="crud-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Transaksi Penjualan</span>
            <h2>Data Transaksi</h2>
            <p>
                Halaman ini digunakan untuk mencatat dan mengelola transaksi
                penjualan sepatu.
            </p>
        </div>

        <a href="{{ route('transaksi.create') }}" class="crud-button">
            Tambah Transaksi
        </a>
    </div>

    <form action="{{ route('transaksi.index') }}" method="GET" class="search-form">
        <div class="search-group">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari kode transaksi, pelanggan, produk, tanggal, pembayaran, atau status...">

            <button type="submit" class="crud-button search-button">
                Cari
            </button>

            @if (!empty($search))
            <a href="{{ route('transaksi.index') }}" class="crud-button secondary search-button">
                Reset
            </a>
            @endif
        </div>
    </form>

    @if (!empty($search))
    <div class="search-result-info">
        <p>
            Hasil pencarian untuk:
            <strong>{{ $search }}</strong>
        </p>

        <span>
            Ditemukan {{ $transaksis->total() }} data transaksi.
        </span>
    </div>
    @endif

    @if (session('success'))
    <div class="crud-alert">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="crud-alert danger">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="crud-alert danger">
        {{ $errors->first() }}
    </div>
    @endif

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Batas Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($transaksis as $transaksi)
                <tr>
                    <td>
                        {{ $loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage() }}
                    </td>

                    <td>{{ $transaksi->kode_transaksi }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}
                    </td>

                    <td>{{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}</td>

                    <td>{{ $transaksi->detailTransaksi->produk->nama_produk ?? '-' }}</td>

                    <td>{{ $transaksi->detailTransaksi->jumlah ?? 0 }}</td>

                    <td>
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </td>

                    <td>
                        @php
                        $metodePembayaran = $transaksi->metode_pembayaran ?? '-';

                        $paymentClass = match ($metodePembayaran) {
                        'COD' => 'cod',
                        'Transfer Bank' => 'transfer',
                        'QRIS Simulasi' => 'qris',
                        default => 'default',
                        };
                        @endphp

                        <span class="payment-badge {{ $paymentClass }}">
                            {{ $metodePembayaran }}
                        </span>
                    </td>

                    <td>
                        @if ($transaksi->payment_deadline)
                        <span class="deadline-badge">
                            {{ \Carbon\Carbon::parse($transaksi->payment_deadline)->format('d M Y H:i') }}
                        </span>
                        @else
                        <span class="deadline-badge empty">
                            -
                        </span>
                        @endif
                    </td>

                    <td>
                        @php
                        $statusClass = match ($transaksi->status) {
                        'Selesai' => 'selesai',
                        'Pending' => 'pending',
                        'Kadaluarsa' => 'kadaluarsa',
                        default => 'default',
                        };
                        @endphp

                        <span class="status-badge {{ $statusClass }}">
                            {{ $transaksi->status }}
                        </span>
                    </td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn-detail">
                                Detail
                            </a>

                            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn-edit">
                                Edit
                            </a>
                            <a
                                href="{{ route('transaksi.invoice', $transaksi->id) }}"
                                target="_blank"
                                class="btn-invoice">
                                Invoice
                            </a>

                            @if ($transaksi->status === 'Pending')
                            <form
                                action="{{ route('transaksi.konfirmasi', $transaksi->id) }}"
                                method="POST"
                                class="confirm-form">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn-confirm">
                                    Konfirmasi
                                </button>
                            </form>
                            @endif

                            <form
                                action="{{ route('transaksi.destroy', $transaksi->id) }}"
                                method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="empty-table">
                        Belum ada data transaksi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $transaksis->links() }}
    </div>
</section>
@endsection