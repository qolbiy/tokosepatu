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
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span>DB</span>
                    Dashboard
                </a>

                <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                    <span>PL</span>
                    Data Pelanggan
                </a>

                <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <span>KT</span>
                    Data Kategori
                </a>

                <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
                    <span>PR</span>
                    Data Produk
                </a>

                <a href="{{ route('transaksi.index') }}" class="{{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                    <span>TR</span>
                    Data Transaksi
                </a>

                <a href="{{ route('proses-etl.index') }}" class="{{ request()->routeIs('proses-etl.*') ? 'active' : '' }}">
                    <span>ETL</span>
                    Proses ETL
                </a>


                <a href="{{ route('data-warehouse.index') }}" class="{{ request()->routeIs('data-warehouse.*') ? 'active' : '' }}">
                    <span>DW</span>
                    Data Warehouse
                </a>

                <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <span>LP</span>
                    Laporan
                </a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="{{ route('landing') }}">Kembali ke Landing Page</a>
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <button class="admin-menu-toggle" id="adminMenuToggle" type="button">
                    <span></span>
                    <span></span>
                    <span></span>
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