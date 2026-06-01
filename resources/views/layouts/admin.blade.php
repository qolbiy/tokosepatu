<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - ShoeDW')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="admin-layout" id="adminLayout">
        <div class="admin-overlay" id="adminOverlay"></div>

        <aside class="admin-sidebar" id="adminSidebar">
            <div class="admin-brand-wrapper">
                <div class="admin-brand">
                    <span class="brand-icon"></span>
                    <span>Shoe<span>DW</span></span>
                </div>

                <button class="sidebar-collapse-btn" id="sidebarCollapseBtn" type="button">
                    <span></span>
                </button>
            </div>

            <nav class="admin-menu">
                <div class="admin-menu-group">
                    <span class="admin-menu-title">Main</span>

                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span>DB</span>
                        <strong>Dashboard</strong>
                    </a>
                </div>

                <div class="admin-menu-group">
                    <span class="admin-menu-title">Master Data</span>

                    <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                        <span>PL</span>
                        <strong>Data Pelanggan</strong>
                    </a>

                    <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <span>KT</span>
                        <strong>Data Kategori</strong>
                    </a>

                    <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
                        <span>PR</span>
                        <strong>Data Produk</strong>
                    </a>
                </div>

                <div class="admin-menu-group">
                    <span class="admin-menu-title">Transaksi</span>

                    <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                        <span>TR</span>
                        <strong>Data Transaksi</strong>
                    </a>
                </div>

                <div class="admin-menu-group">
                    <span class="admin-menu-title">Data Warehouse</span>

                    <a href="{{ route('proses-etl.index') }}" class="{{ request()->routeIs('proses-etl.*') ? 'active' : '' }}">
                        <span>ETL</span>
                        <strong>Proses ETL</strong>
                    </a>

                    <a href="{{ route('data-warehouse.index') }}" class="{{ request()->routeIs('data-warehouse.*') ? 'active' : '' }}">
                        <span>DW</span>
                        <strong>Data Warehouse</strong>
                    </a>
                </div>

                <div class="admin-menu-group">
                    <span class="admin-menu-title">Analisis</span>

                    <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        <span>LP</span>
                        <strong>Laporan</strong>
                    </a>
                </div>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="{{ route('landing') }}">Kembali ke Landing Page</a>
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <button class="admin-menu-toggle" id="adminMenuToggle" type="button" aria-label="Buka menu">
                    <svg class="admin-menu-svg admin-menu-svg-open" viewBox="0 0 24 24" fill="none">
                        <path d="M4 7H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
                        <path d="M4 12H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
                        <path d="M4 17H20" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
                    </svg>

                    <svg class="admin-menu-svg admin-menu-svg-close" viewBox="0 0 24 24" fill="none">
                        <path d="M6 6L18 18" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
                        <path d="M18 6L6 18" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" />
                    </svg>
                </button>

                <div>
                    <h1>@yield('page-title')</h1>
                    <p>@yield('page-subtitle')</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-button">
                        Logout
                    </button>
                </form>
            </header>

            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>