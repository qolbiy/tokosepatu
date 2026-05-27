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
                placeholder="Cari kode transaksi, pelanggan, produk, tanggal, atau status...">

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

                    <td>
                        {{ $transaksi->pelanggan->nama_pelanggan ?? '-' }}
                    </td>

                    <td>
                        {{ $transaksi->detailTransaksi->produk->nama_produk ?? '-' }}
                    </td>

                    <td>
                        {{ $transaksi->detailTransaksi->jumlah ?? 0 }}
                    </td>

                    <td>
                        Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ $transaksi->status }}
                    </td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn-detail">
                                Detail
                            </a>

                            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn-edit">
                                Edit
                            </a>

                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
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
                    <td colspan="9" class="empty-table">
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