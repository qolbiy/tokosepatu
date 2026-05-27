@extends('layouts.admin')

@section('title', 'Detail Pelanggan - ShoeDW')
@section('page-title', 'Detail Pelanggan')
@section('page-subtitle', 'Informasi lengkap data pelanggan toko sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Detail Data</span>
            <h2>{{ $pelanggan->nama_pelanggan }}</h2>
            <p>Detail data pelanggan toko sepatu.</p>
        </div>

    </div>

    <div class="detail-grid">
        <div class="detail-item">
            <span>Nama Pelanggan</span>
            <strong>{{ $pelanggan->nama_pelanggan }}</strong>
        </div>

        <div class="detail-item">
            <span>Email</span>
            <strong>{{ $pelanggan->email ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>No HP</span>
            <strong>{{ $pelanggan->no_hp ?? '-' }}</strong>
        </div>

        <div class="detail-item">
            <span>Jenis Kelamin</span>
            <strong>{{ $pelanggan->jenis_kelamin ?? '-' }}</strong>
        </div>

        <div class="detail-item full">
            <span>Alamat</span>
            <strong>{{ $pelanggan->alamat ?? '-' }}</strong>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="crud-button">
            Edit Data
        </a>

        <a href="{{ route('pelanggan.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>
</section>
@endsection