@extends('layouts.admin')

@section('title', 'Data Pelanggan - ShoeDW')
@section('page-title', 'Data Pelanggan')
@section('page-subtitle', 'Kelola data pelanggan toko sepatu.')

@section('content')
<section class="crud-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Master Data</span>
            <h2>Data Pelanggan</h2>
            <p>
                Halaman ini digunakan untuk menambah, melihat, mengubah,
                dan menghapus data pelanggan toko sepatu.
            </p>
        </div>

        <a href="{{ route('pelanggan.create') }}" class="crud-button">
            Tambah Pelanggan
        </a>
    </div>

    <form action="{{ route('pelanggan.index') }}" method="GET" class="search-form">
        <div class="search-group">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari nama, email, no HP, alamat, atau jenis kelamin...">

            <button type="submit" class="crud-button">
                Cari
            </button>

            @if (!empty($search))
            <a href="{{ route('pelanggan.index') }}" class="crud-button secondary">
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
            Ditemukan {{ $pelanggans->total() }} data pelanggan.
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
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pelanggans as $pelanggan)
                <tr>
                    <td>
                        {{ $loop->iteration + ($pelanggans->currentPage() - 1) * $pelanggans->perPage() }}
                    </td>

                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                    <td>{{ $pelanggan->email ?? '-' }}</td>
                    <td>{{ $pelanggan->no_hp ?? '-' }}</td>
                    <td>{{ $pelanggan->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $pelanggan->alamat ?? '-' }}</td>

                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('pelanggan.show', $pelanggan->id) }}" class="btn-detail">
                                Detail
                            </a>

                            <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn-edit">
                                Edit
                            </a>

                            <form
                                action="{{ route('pelanggan.destroy', $pelanggan->id) }}"
                                method="POST"
                                class="delete-pelanggan-form"
                                data-nama="{{ $pelanggan->nama_pelanggan }}">
                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn-delete delete-pelanggan-button">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-table">
                        Belum ada data pelanggan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $pelanggans->links() }}
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-pelanggan-button');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const form = button.closest('.delete-pelanggan-form');
                const namaPelanggan = form.dataset.nama || 'data pelanggan ini';

                Swal.fire({
                    title: 'Hapus Data Pelanggan?',
                    text: 'Data pelanggan "' + namaPelanggan + '" akan dihapus dari sistem.',
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