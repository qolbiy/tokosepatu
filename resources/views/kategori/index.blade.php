@extends('layouts.admin')

@section('title', 'Data Kategori - ShoeDW')
@section('page-title', 'Data Kategori')
@section('page-subtitle', 'Kelola data kategori produk sepatu.')

@section('content')
<section class="crud-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Master Data</span>
            <h2>Data Kategori Sepatu</h2>
            <p>
                Halaman ini digunakan untuk mengelola kategori produk sepatu
                seperti sneakers, running shoes, formal shoes, dan lainnya.
            </p>
        </div>

        <a href="{{ route('kategori.create') }}" class="crud-button">
            Tambah Kategori
        </a>
    </div>

    <form action="{{ route('kategori.index') }}" method="GET" class="search-form">
    <div class="search-group">
        <input 
            type="text" 
            name="search" 
            value="{{ $search ?? '' }}" 
            placeholder="Cari kode kategori, nama kategori, atau deskripsi..."
        >

        <button type="submit" class="crud-button search-button">
            Cari
        </button>

        @if (!empty($search))
            <a href="{{ route('kategori.index') }}" class="crud-button secondary search-button">
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
            Ditemukan {{ $kategoris->total() }} data kategori.
        </span>
    </div>
@endif

    @if (session('success'))
        <div class="crud-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kategoris as $kategori)
                    <tr>
                        <td>
                            {{ $loop->iteration + ($kategoris->currentPage() - 1) * $kategoris->perPage() }}
                        </td>
                        <td>{{ $kategori->kode_kategori }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                        <td>{{ $kategori->deskripsi ?? '-' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('kategori.show', $kategori->id) }}" class="btn-detail">
                                    Detail
                                </a>

                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn-edit">
                                    Edit
                                </a>

                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data kategori ini?')">
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
                        <td colspan="5" class="empty-table">
                            Belum ada data kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $kategoris->links() }}
    </div>
</section>
@endsection