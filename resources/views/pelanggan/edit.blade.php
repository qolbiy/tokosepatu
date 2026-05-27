@extends('layouts.admin')

@section('title', 'Edit Pelanggan - ShoeDW')
@section('page-title', 'Edit Pelanggan')
@section('page-subtitle', 'Perbarui data pelanggan toko sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Form Pelanggan</span>
            <h2>Edit Data Pelanggan</h2>
            <p>Ubah data pelanggan toko sepatu sesuai kebutuhan.</p>
        </div>

        <a href="{{ route('pelanggan.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST" class="crud-form">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" placeholder="Masukkan nama pelanggan">

                @error('nama_pelanggan')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $pelanggan->email) }}" placeholder="Masukkan email pelanggan">

                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp) }}" placeholder="Masukkan nomor HP">

                @error('no_hp')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin">
                    <option value="">Pilih jenis kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>

                @error('jenis_kelamin')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full">
                <label>Alamat</label>
                <textarea name="alamat" rows="4" placeholder="Masukkan alamat pelanggan">{{ old('alamat', $pelanggan->alamat) }}</textarea>

                @error('alamat')
                    <small>{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="crud-button">
                Update Data
            </button>

            <a href="{{ route('pelanggan.index') }}" class="crud-button secondary">
                Batal
            </a>
        </div>
    </form>
</section>
@endsection