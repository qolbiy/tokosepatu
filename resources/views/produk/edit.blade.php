@extends('layouts.admin')

@section('title', 'Edit Produk - ShoeDW')
@section('page-title', 'Edit Produk')
@section('page-subtitle', 'Perbarui data produk sepatu.')

@section('content')
<section class="crud-card form-card">
    <div class="crud-header">
        <div>
            <span class="hero-badge">Form Produk</span>
            <h2>Edit Data Produk</h2>
            <p>Ubah data produk sepatu sesuai kebutuhan.</p>
        </div>

        <a href="{{ route('produk.index') }}" class="crud-button secondary">
            Kembali
        </a>
    </div>

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" class="crud-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-grid">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" placeholder="Contoh: Sneakers Casual">
                @error('nama_produk')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" class="w-full border rounded px-2 py-1">
                    <option value="">Pilih kategori</option>
                    @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
                <input type="text" name="merek" value="{{ old('merek', $produk->merek) }}" placeholder="Contoh: Nike">
                @error('merek')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Ukuran</label>
                <input type="text" name="ukuran" value="{{ old('ukuran', $produk->ukuran) }}" placeholder="Contoh: 39, 40, 41">
                @error('ukuran')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Warna</label>
                <input type="text" name="warna" value="{{ old('warna', $produk->warna) }}" placeholder="Contoh: Hitam">
                @error('warna')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" min="0" placeholder="Masukkan stok">
                @error('stok')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" value="{{ old('harga_beli', $produk->harga_beli) }}" min="0" placeholder="Masukkan harga beli">
                @error('harga_beli')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}" min="0" placeholder="Masukkan harga jual">
                @error('harga_jual')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi produk" class="w-full border rounded px-2 py-1">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                @error('deskripsi')
                <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group full">
                <label>Foto Produk Saat Ini</label>

                <div class="edit-product-photo-preview">
                    <img
                        src="{{ $produk->foto ? asset('storage/produk/' . $produk->foto) : asset('storage/produk/default-shoe.jpg') }}"
                        alt="{{ $produk->nama_produk }}">
                </div>
            </div>

            <div class="form-group full">
                <label>Ganti Foto Produk</label>

                <div class="photo-upload-wrapper" id="editPhotoUploadWrapper">
                    <input
                        type="file"
                        name="foto"
                        id="editFotoProdukInput"
                        accept="image/jpeg,image/png,image/jpg"
                        class="photo-upload-input">

                    <div class="photo-upload-content" id="editPhotoUploadContent">
                        <div class="photo-upload-icon">
                            <span>+</span>
                        </div>

                        <div>
                            <h4>Pilih atau seret foto produk</h4>
                            <p>Kosongkan jika tidak ingin mengganti foto. Format JPG, JPEG, atau PNG. Maksimal 2MB.</p>
                        </div>

                        <button type="button" class="photo-upload-button" id="editPhotoUploadButton">
                            Pilih Foto
                        </button>
                    </div>

                    <div class="photo-preview-content" id="editPhotoPreviewContent">
                        <div class="photo-preview-box">
                            <img src="" alt="Preview Foto Produk" id="editPhotoPreviewImage">
                        </div>

                        <div class="photo-preview-info">
                            <h4 id="editPhotoFileName">Nama file</h4>
                            <p>Foto baru berhasil dipilih. Klik area ini untuk mengganti foto kembali.</p>
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
                Update Data
            </button>

            <a href="{{ route('produk.index') }}" class="crud-button secondary">
                Batal
            </a>
        </div>
    </form>
</section>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.getElementById('editPhotoUploadWrapper');
        const input = document.getElementById('editFotoProdukInput');
        const button = document.getElementById('editPhotoUploadButton');
        const uploadContent = document.getElementById('editPhotoUploadContent');
        const previewContent = document.getElementById('editPhotoPreviewContent');
        const previewImage = document.getElementById('editPhotoPreviewImage');
        const fileName = document.getElementById('editPhotoFileName');

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