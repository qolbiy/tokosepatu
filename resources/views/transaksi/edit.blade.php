@extends('layouts.admin')

@section('title', 'Edit Transaksi - ShoeDW')
@section('page-title', 'Edit Transaksi')
@section('page-subtitle', 'Perbarui transaksi penjualan sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Form Transaksi</span>
            <h2>Edit Transaksi</h2>
            <p>Ubah data transaksi penjualan sepatu sesuai kebutuhan.</p>
        </div>

        <a href="{{ route('transaksi.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="crud-alert danger">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label>Pelanggan</label>
                <select name="pelanggan_id">
                    <option value="">Pilih pelanggan</option>

                    @foreach ($produks as $produk)
                    <option
                        value="{{ $produk->id }}"
                        {{ old('produk_id', $transaksi->detailTransaksi->produk_id ?? '') == $produk->id ? 'selected' : '' }}
                        {{ $produk->stok <= 0 && old('produk_id', $transaksi->detailTransaksi->produk_id ?? '') != $produk->id ? 'disabled' : '' }}>
                        {{ $produk->nama_produk }}
                        - {{ $produk->kategori->nama_kategori ?? '-' }}
                        - Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                        - Stok {{ $produk->stok }}
                        {{ $produk->stok <= 0 ? '- Stok Habis' : '' }}
                    </option>
                    @endforeach
                </select>

                @error('pelanggan_id')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Produk</label>
                <select name="produk_id">
                    <option value="">Pilih produk</option>

                    @foreach ($produks as $produk)
                    <option value="{{ $produk->id }}" {{ old('produk_id', $transaksi->detailTransaksi->produk_id ?? '') == $produk->id ? 'selected' : '' }}>
                        {{ $produk->nama_produk }}
                        - {{ $produk->kategori->nama_kategori ?? '-' }}
                        - Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                        - Stok {{ $produk->stok }}
                    </option>
                    @endforeach
                </select>

                @error('produk_id')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Transaksi</label>
                <input
                    type="date"
                    name="tanggal_transaksi"
                    value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}">

                @error('tanggal_transaksi')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input
                    type="number"
                    name="jumlah"
                    value="{{ old('jumlah', $transaksi->detailTransaksi->jumlah ?? 1) }}"
                    min="1"
                    placeholder="Masukkan jumlah pembelian">

                @error('jumlah')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Selesai" {{ old('status', $transaksi->status) == 'Selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="Pending" {{ old('status', $transaksi->status) == 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Dibatalkan" {{ old('status', $transaksi->status) == 'Dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>
                </select>

                @error('status')
                <small>{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="crud-button">
                Update Transaksi
            </button>

            <a href="{{ route('transaksi.index') }}" class="crud-button secondary">
                Batal
            </a>
        </div>
    </form>
</section>
@endsection