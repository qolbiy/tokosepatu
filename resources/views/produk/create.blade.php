@extends('layouts.admin')

@section('title', 'Tambah Produk - ShoeDW')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Tambahkan data produk sepatu baru.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Form Produk</span>
            <h2>Tambah Data Produk</h2>
            <p>Isi form berikut untuk menambahkan data produk sepatu.</p>
        </div>

        <a href="{{ route('produk.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <form action="{{ route('produk.store') }}" method="POST" class="crud-form" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Contoh: Adidas Stan Smith">

                @error('nama_produk')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id">
                    <option value="">Pilih kategori</option>

                    @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                    @endforeach
                </select>

                @error('kategori_id')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Merek</label>
                <input type="text" name="merek" value="{{ old('merek') }}" placeholder="Contoh: Adidas">

                @error('merek')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Ukuran</label>
                <input type="text" name="ukuran" value="{{ old('ukuran') }}" placeholder="Contoh: 39-44">

                @error('ukuran')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Warna</label>
                <input type="text" name="warna" value="{{ old('warna') }}" placeholder="Contoh: Putih Hijau">

                @error('warna')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" value="{{ old('stok', 0) }}" min="0" placeholder="Masukkan stok">

                @error('stok')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" value="{{ old('harga_beli', 0) }}" min="0" placeholder="Masukkan harga beli">

                @error('harga_beli')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" value="{{ old('harga_jual', 0) }}" min="0" placeholder="Masukkan harga jual">

                @error('harga_jual')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi produk">{{ old('deskripsi') }}</textarea>

                @error('deskripsi')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full">
                <label>Foto Produk</label>

                <div class="photo-upload-wrapper" id="photoUploadWrapper">
                    <input
                        type="file"
                        name="foto"
                        id="fotoProdukInput"
                        accept="image/jpeg,image/png,image/jpg"
                        class="photo-upload-input">

                    <div class="photo-upload-content" id="photoUploadContent">
                        <div class="photo-upload-icon">
                            <span>+</span>
                        </div>

                        <h4>Pilih atau seret foto produk</h4>
                        <p>Gunakan gambar produk dengan format JPG, JPEG, atau PNG. Maksimal 2MB.</p>

                        <button type="button" class="photo-upload-button" id="photoUploadButton">
                            Pilih Foto
                        </button>
                    </div>

                    <div class="photo-preview-content" id="photoPreviewContent">
                        <div class="photo-preview-box">
                            <img src="" alt="Preview Foto Produk" id="photoPreviewImage">
                        </div>

                        <div class="photo-preview-info">
                            <h4 id="photoFileName">Nama file</h4>
                            <p>Foto berhasil dipilih. Klik area ini untuk mengganti foto.</p>
                        </div>
                    </div>
                </div>

                @error('foto')
                <small>{{ $message }}</small>
                @enderror
            </div>

            
        </div>

        <div class="form-actions">
            <button type="submit" class="crud-button">
                Simpan Data
            </button>

            <a href="{{ route('produk.index') }}" class="crud-button secondary">
                Batal
            </a>
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.getElementById('photoUploadWrapper');
        const input = document.getElementById('fotoProdukInput');
        const button = document.getElementById('photoUploadButton');
        const uploadContent = document.getElementById('photoUploadContent');
        const previewContent = document.getElementById('photoPreviewContent');
        const previewImage = document.getElementById('photoPreviewImage');
        const fileName = document.getElementById('photoFileName');

        function showPreview(file) {
            if (!file) {
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

            if (!allowedTypes.includes(file.type)) {
                alert('Format foto harus JPG, JPEG, atau PNG.');
                input.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran foto maksimal 2MB.');
                input.value = '';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                previewImage.src = event.target.result;
                fileName.textContent = file.name;

                uploadContent.style.display = 'none';
                previewContent.style.display = 'flex';
            };

            reader.readAsDataURL(file);
        }

        wrapper.addEventListener('click', function () {
            input.click();
        });

        button.addEventListener('click', function (event) {
            event.stopPropagation();
            input.click();
        });

        input.addEventListener('change', function () {
            showPreview(input.files[0]);
        });

        wrapper.addEventListener('dragover', function (event) {
            event.preventDefault();
            wrapper.classList.add('dragging');
        });

        wrapper.addEventListener('dragleave', function () {
            wrapper.classList.remove('dragging');
        });

        wrapper.addEventListener('drop', function (event) {
            event.preventDefault();
            wrapper.classList.remove('dragging');

            const file = event.dataTransfer.files[0];

            if (file) {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;

                showPreview(file);
            }
        });
    });
</script>
@endsection