<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - ShoeDW</title>

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

                <span class="hero-badge">Dashboard Admin</span>

                <h1>
                    Masuk ke
                    <span>Dashboard</span>
                    Data Warehouse
                </h1>

                <p>
                    Login sebagai admin untuk mengelola data operasional,
                    menjalankan proses ETL, melihat Star Schema, dan memantau
                    laporan analisis toko sepatu.
                </p>

                <div class="auth-points">
                    <div>
                        <strong>ETL</strong>
                        <span>Proses data operasional ke warehouse</span>
                    </div>

                    <div>
                        <strong>DW</strong>
                        <span>Data warehouse dengan model Star Schema</span>
                    </div>

                    <div>
                        <strong>Report</strong>
                        <span>Laporan penjualan berbasis grafik</span>
                    </div>
                </div>
            </div>

            <div class="auth-card">
                <div class="auth-card-header">
                    <h2>Login Admin</h2>
                    <p>Masukkan email dan password admin.</p>
                </div>

                @if (session('status'))
                    <div class="auth-alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
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
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                        >

                        @error('password')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span>Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Lupa password?</a>
                        @endif
                    </div>

                    <button type="submit" class="auth-button">
                        Login Admin
                    </button>

                    <p class="auth-switch">
                        Belum punya akun admin?
                        <a href="{{ route('register') }}">Register Admin</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
</body>
</html>