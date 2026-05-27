@extends('layouts.admin')

@section('title', 'Tambah Transaksi - ShoeDW')
@section('page-title', 'Tambah Transaksi')
@section('page-subtitle', 'Tambahkan transaksi penjualan sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Form Transaksi</span>
            <h2>Tambah Transaksi</h2>
            <p>Isi form berikut untuk mencatat transaksi penjualan sepatu.</p>
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

    <form action="{{ route('transaksi.store') }}" method="POST" class="crud-form">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Pelanggan</label>
                <select name="pelanggan_id">
                    <option value="">Pilih pelanggan</option>

                    @foreach ($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->nama_pelanggan }}
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
                    <option
                        value="{{ $produk->id }}"
                        {{ old('produk_id') == $produk->id ? 'selected' : '' }}
                        {{ $produk->stok <= 0 ? 'disabled' : '' }}>
                        {{ $produk->nama_produk }}
                        - {{ $produk->kategori->nama_kategori ?? '-' }}
                        - Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                        - Stok {{ $produk->stok }}
                        {{ $produk->stok <= 0 ? '- Stok Habis' : '' }}
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
                    value="{{ old('tanggal_transaksi', date('Y-m-d')) }}">

                @error('tanggal_transaksi')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input
                    type="number"
                    name="jumlah"
                    value="{{ old('jumlah', 1) }}"
                    min="1"
                    placeholder="Masukkan jumlah pembelian">

                @error('jumlah')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Dibatalkan" {{ old('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                @error('status')
                <small>{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="crud-button">
                Simpan Transaksi
            </button>

            <a href="{{ route('transaksi.index') }}" class="crud-button secondary">
                Batal
            </a>
        </div>
    </form>
</section>
@endsection