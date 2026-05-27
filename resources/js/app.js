import './bootstrap';
import AOS from 'aos';
import Chart from 'chart.js/auto';

/* =========================
   AOS ANIMATION
   ========================= */

AOS.init({
    duration: 900,
    once: true,
    offset: 120,
    easing: 'ease-out-cubic',
});

window.addEventListener('load', () => {
    AOS.refresh();
});

/* =========================
   LANDING NAVBAR MOBILE
   ========================= */

const menuToggle = document.getElementById('menuToggle');
const navMenu = document.getElementById('navMenu');
const navLinks = document.querySelectorAll('.nav-menu a');

if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
        document.body.classList.toggle('menu-open');
    });

    navLinks.forEach((link) => {
        link.addEventListener('click', () => {
            menuToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    });
}

/* =========================
   ADMIN SIDEBAR
   ========================= */

const adminLayout = document.getElementById('adminLayout');
const adminMenuToggle = document.getElementById('adminMenuToggle');
const adminSidebar = document.getElementById('adminSidebar');
const adminOverlay = document.getElementById('adminOverlay');
const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');

if (adminMenuToggle && adminSidebar) {
    adminMenuToggle.addEventListener('click', () => {
        adminSidebar.classList.toggle('active');

        if (adminOverlay) {
            adminOverlay.classList.toggle('active');
        }
    });
}

if (adminOverlay && adminSidebar) {
    adminOverlay.addEventListener('click', () => {
        adminSidebar.classList.remove('active');
        adminOverlay.classList.remove('active');
    });
}

if (sidebarCollapseBtn && adminLayout) {
    sidebarCollapseBtn.addEventListener('click', () => {
        adminLayout.classList.toggle('sidebar-collapsed');
    });
}

/* =========================
   HELPER FUNCTION
   ========================= */

function parseChartData(element) {
    if (!element) {
        return {
            labels: [],
            values: [],
        };
    }

    return {
        labels: JSON.parse(element.dataset.labels || '[]'),
        values: JSON.parse(element.dataset.values || '[]'),
    };
}

function formatRupiah(value) {
    return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
}

/* =========================
   LANDING CHART - PENJUALAN BULANAN
   ========================= */

const salesChartElement = document.getElementById('salesChart');
const landingSalesChartDataElement = document.getElementById('landingSalesChartData');

if (salesChartElement && landingSalesChartDataElement) {
    const { labels, values } = parseChartData(landingSalesChartDataElement);

    new Chart(salesChartElement, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pendapatan',
                    data: values,
                    backgroundColor: '#8b5cf6',
                    borderRadius: 12,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#64748b',
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return 'Pendapatan: ' + formatRupiah(context.raw);
                        },
                    },
                },
            },
            scales: {
                x: {
                    ticks: {
                        color: '#64748b',
                    },
                    grid: {
                        display: false,
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#64748b',
                        callback: function (value) {
                            return formatRupiah(value);
                        },
                    },
                    grid: {
                        color: '#e2e8f0',
                    },
                },
            },
        },
    });
}

/* =========================
   LANDING CHART - KATEGORI TERLARIS
   ========================= */

const categoryChartElement = document.getElementById('categoryChart');
const landingCategoryChartDataElement = document.getElementById('landingCategoryChartData');

if (categoryChartElement && landingCategoryChartDataElement) {
    const { labels, values } = parseChartData(landingCategoryChartDataElement);

    new Chart(categoryChartElement, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Kategori Terjual',
                    data: values,
                    backgroundColor: [
                        '#8b5cf6',
                        '#38bdf8',
                        '#22c55e',
                        '#f59e0b',
                        '#f472b6',
                        '#6366f1',
                        '#14b8a6',
                        '#ef4444',
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 4,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '62%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#64748b',
                        padding: 14,
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + context.raw + ' produk';
                        },
                    },
                },
            },
        },
    });
}

/* =========================
   LANDING CHART - PRODUK TERLARIS
   ========================= */

const landingPopularProductChartElement = document.getElementById('landingPopularProductChart');
const landingPopularProductChartDataElement = document.getElementById('landingPopularProductChartData');

if (landingPopularProductChartElement && landingPopularProductChartDataElement) {
    const { labels, values } = parseChartData(landingPopularProductChartDataElement);

    new Chart(landingPopularProductChartElement, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Terjual',
                    data: values,
                    backgroundColor: '#38bdf8',
                    borderRadius: 12,
                    barThickness: 34,
                },
            ],
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#64748b',
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return 'Terjual: ' + context.raw + ' produk';
                        },
                    },
                },
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        color: '#64748b',
                        precision: 0,
                    },
                    grid: {
                        color: '#e2e8f0',
                    },
                },
                y: {
                    ticks: {
                        color: '#64748b',
                    },
                    grid: {
                        display: false,
                    },
                },
            },
        },
    });
}

/* =========================
   DASHBOARD CHART - PENDAPATAN
   ========================= */

const dashboardRevenueChartElement = document.getElementById('dashboardRevenueChart');
const dashboardRevenueChartDataElement = document.getElementById('dashboardRevenueChartData');

if (dashboardRevenueChartElement && dashboardRevenueChartDataElement) {
    const { labels, values } = parseChartData(dashboardRevenueChartDataElement);

    new Chart(dashboardRevenueChartElement, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pendapatan',
                    data: values,
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.12)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#8b5cf6',
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#475569',
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return 'Pendapatan: ' + formatRupiah(context.raw);
                        },
                    },
                },
            },
            scales: {
                x: {
                    ticks: {
                        color: '#64748b',
                    },
                    grid: {
                        display: false,
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#64748b',
                        callback: function (value) {
                            return formatRupiah(value);
                        },
                    },
                    grid: {
                        color: '#e2e8f0',
                    },
                },
            },
        },
    });
}

/* =========================
   LAPORAN CHART - PENDAPATAN BULANAN
   ========================= */

const laporanPendapatanChartElement = document.getElementById('laporanPendapatanChart');
const laporanChartDataElement = document.getElementById('laporanChartData');

if (laporanPendapatanChartElement && laporanChartDataElement) {
    const { labels, values } = parseChartData(laporanChartDataElement);

    new Chart(laporanPendapatanChartElement, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pendapatan',
                    data: values,
                    backgroundColor: '#8b5cf6',
                    borderRadius: 12,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#475569',
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return 'Pendapatan: ' + formatRupiah(context.raw);
                        },
                    },
                },
            },
            scales: {
                x: {
                    ticks: {
                        color: '#64748b',
                    },
                    grid: {
                        display: false,
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#64748b',
                        callback: function (value) {
                            return formatRupiah(value);
                        },
                    },
                    grid: {
                        color: '#e2e8f0',
                    },
                },
            },
        },
    });
}

/* =========================
   LAPORAN CHART - KATEGORI TERLARIS
   ========================= */

const kategoriTerlarisChartElement = document.getElementById('kategoriTerlarisChart');
const kategoriChartDataElement = document.getElementById('kategoriChartData');

if (kategoriTerlarisChartElement && kategoriChartDataElement) {
    const { labels, values } = parseChartData(kategoriChartDataElement);

    new Chart(kategoriTerlarisChartElement, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Kategori Terjual',
                    data: values,
                    backgroundColor: [
                        '#8b5cf6',
                        '#38bdf8',
                        '#22c55e',
                        '#f472b6',
                        '#f59e0b',
                        '#6366f1',
                        '#14b8a6',
                        '#ef4444',
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 4,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '62%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#475569',
                        padding: 16,
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + context.raw + ' produk';
                        },
                    },
                },
            },
        },
    });
}

/* =========================
   LAPORAN CHART - PRODUK TERLARIS
   ========================= */

const produkTerlarisChartElement = document.getElementById('produkTerlarisChart');
const produkChartDataElement = document.getElementById('produkChartData');

if (produkTerlarisChartElement && produkChartDataElement) {
    const { labels, values } = parseChartData(produkChartDataElement);

    new Chart(produkTerlarisChartElement, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Total Terjual',
                    data: values,
                    backgroundColor: '#38bdf8',
                    borderRadius: 12,
                },
            ],
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#475569',
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return 'Terjual: ' + context.raw + ' produk';
                        },
                    },
                },
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        color: '#64748b',
                        precision: 0,
                    },
                    grid: {
                        color: '#e2e8f0',
                    },
                },
                y: {
                    ticks: {
                        color: '#64748b',
                    },
                    grid: {
                        display: false,
                    },
                },
            },
        },
    });
}