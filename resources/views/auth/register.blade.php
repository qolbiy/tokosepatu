<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - ShoeDW</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <section class="auth-page">
        <div class="auth-bubble auth-bubble-one"></div>
        <div class="auth-bubble auth-bubble-two"></div>
        <div class="auth-bubble auth-bubble-three"></div>

        <div class="auth-container">
            <div class="auth-info">
                <a href="{{ route('landing') }}" class="brand auth-brand">
                    <span class="brand-icon"></span>
                    <span>Shoe<span>DW</span></span>
                </a>

                <span class="hero-badge">Register Admin</span>

                <h1>
                    Buat Akun
                    <span>Admin</span>
                    ShoeDW
                </h1>

                <p>
                    Buat akun admin untuk mengakses dashboard pengelolaan data
                    toko sepatu, proses ETL, data warehouse, dan laporan analisis.
                </p>

                <div class="auth-points">
                    <div>
                        <strong>Manage</strong>
                        <span>Kelola produk, pelanggan, dan transaksi</span>
                    </div>

                    <div>
                        <strong>Analyze</strong>
                        <span>Analisis penjualan berdasarkan data warehouse</span>
                    </div>

                    <div>
                        <strong>Monitor</strong>
                        <span>Pantau performa toko melalui grafik</span>
                    </div>
                </div>
            </div>

            <div class="auth-card">
                <div class="auth-card-header">
                    <h2>Register Admin</h2>
                    <p>Daftarkan akun admin baru.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Admin</label>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Masukkan nama admin"
                        >

                        @error('name')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="Masukkan email admin"
                        >

                        @error('email')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Masukkan password"
                        >

                        @error('password')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi password"
                        >

                        @error('password_confirmation')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="auth-button">
                        Register Admin
                    </button>

                    <p class="auth-switch">
                        Sudah punya akun admin?
                        <a href="{{ route('login') }}">Login Admin</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</body>
</html>