@extends('layouts.admin')

@section('title', 'Data Produk - ShoeDW')
@section('page-title', 'Data Produk')
@section('page-subtitle', 'Kelola data produk sepatu.')

@section('content')
<section class="crud-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Master Data</span>
            <h2>Data Produk Sepatu</h2>
            <p>
                Halaman ini digunakan untuk menambah, melihat, mengubah,
                dan menghapus data produk sepatu.
            </p>
        </div>

        <a href="{{ route('produk.create') }}" class="crud-button">
            Tambah Produk
        </a>
    </div>

    <form action="{{ route('produk.index') }}" method="GET" class="search-form">
        <div class="search-group">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari nama produk, kategori, merek, ukuran, warna, stok, atau harga...">

            <button type="submit" class="crud-button search-button">
                Cari
            </button>

            @if (!empty($search))
            <a href="{{ route('produk.index') }}" class="crud-button secondary search-button">
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
            Ditemukan {{ $produks->total() }} data produk.
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
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Stok</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($produks as $produk)
                <tr>
                    <td>
                        {{ $loop->iteration + ($produks->currentPage() - 1) * $produks->perPage() }}
                    </td>

                    <td>
                        @php
                        $fotoProduk = $produk->foto
                            ? asset('storage/produk/' . $produk->foto)
                            : asset('storage/produk/default-shoe.jpg');
                        @endphp

                        <img
                            src="{{ $fotoProduk }}"
                            alt="{{ $produk->nama_produk }}"
                            class="product-table-img"
                            loading="lazy">
                    </td>

                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $produk->merek ?? '-' }}</td>
                    <td>{{ $produk->ukuran ?? '-' }}</td>
                    <td>{{ $produk->warna ?? '-' }}</td>

                    <td>
                        @if ($produk->stok <= 0)
                            <span class="status-badge danger">Habis</span>
                        @elseif ($produk->stok <= 5)
                            <span class="status-badge warning">{{ $produk->stok }} tersisa</span>
                        @else
                            <span class="status-badge success">{{ $produk->stok }}</span>
                        @endif
                    </td>

                    <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('produk.show', $produk->id) }}" class="btn-detail">
                                Detail
                            </a>

                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn-edit">
                                Edit
                            </a>

                            <form
                                action="{{ route('produk.destroy', $produk->id) }}"
                                method="POST"
                                class="delete-produk-form"
                                data-nama="{{ $produk->nama_produk }}">
                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn-delete delete-produk-button">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="empty-table">
                        Belum ada data produk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $produks->links() }}
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-produk-button');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const form = button.closest('.delete-produk-form');
            const namaProduk = form.dataset.nama || 'data produk ini';

            Swal.fire({
                title: 'Hapus Produk?',
                text: 'Produk "' + namaProduk + '" akan dihapus dari sistem.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection