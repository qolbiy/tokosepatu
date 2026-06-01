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

/* =========================
   TECHNOLOGY MARQUEE CURSOR CONTROL
   ========================= */

const techMarquee = document.getElementById('techMarquee');
const techTrack = document.getElementById('techTrack');

if (techMarquee && techTrack) {
    let position = 0;
    let speed = -0.35;
    let targetSpeed = -0.35;
    let lastMouseX = null;
    let isHovering = false;

    function getLoopWidth() {
        return techTrack.scrollWidth / 3;
    }

    function animateTechMarquee() {
        const loopWidth = getLoopWidth();

        speed += (targetSpeed - speed) * 0.08;
        position += speed;

        if (position <= -loopWidth) {
            position += loopWidth;
        }

        if (position >= 0) {
            position -= loopWidth;
        }

        techTrack.style.transform = `translateX(${position}px)`;

        requestAnimationFrame(animateTechMarquee);
    }

    techMarquee.addEventListener('mouseenter', function (event) {
        isHovering = true;
        lastMouseX = event.clientX;
        targetSpeed = 0;
    });

    techMarquee.addEventListener('mousemove', function (event) {
        if (!isHovering || lastMouseX === null) {
            lastMouseX = event.clientX;
            return;
        }

        const deltaX = event.clientX - lastMouseX;

        if (Math.abs(deltaX) > 1) {
            targetSpeed = deltaX > 0 ? -1.1 : 1.1;
        } else {
            targetSpeed = 0;
        }

        lastMouseX = event.clientX;
    });

    techMarquee.addEventListener('mouseleave', function () {
        isHovering = false;
        lastMouseX = null;
        targetSpeed = -0.35;
    });

    animateTechMarquee();
}

/* =========================
   LANDING PRELOADER
   ========================= */

document.addEventListener('DOMContentLoaded', function () {
    const preloader = document.getElementById('landingPreloader');

    if (preloader) {
        document.body.classList.add('preloader-active');

        setTimeout(function () {
            preloader.classList.add('preloader-hide');
            document.body.classList.remove('preloader-active');

            setTimeout(function () {
                initHeroCounterAnimation();
            }, 450);
        }, 2600);

        setTimeout(function () {
            preloader.remove();
        }, 3600);
    } else {
        initHeroCounterAnimation();
    }
});

/* =========================
   HERO COUNTER ANIMATION ON VIEW
   ========================= */

function initHeroCounterAnimation() {
    const counters = document.querySelectorAll('.counter-number');

    if (!counters.length) {
        return;
    }

    function formatNumber(value) {
        return Math.floor(value).toLocaleString('id-ID');
    }

    function formatCurrencyMillion(value) {
        const formattedValue = value.toLocaleString('id-ID', {
            minimumFractionDigits: 1,
            maximumFractionDigits: 1,
        });

        return `Rp ${formattedValue}Jt`;
    }

    function animateCounter(counter) {
        if (counter.dataset.animated === 'true') {
            return;
        }

        counter.dataset.animated = 'true';

        const target = parseFloat(counter.dataset.target || 0);
        const format = counter.dataset.format;
        const duration = 1800;
        const startTime = performance.now();

        function updateCounter(currentTime) {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            const currentValue = target * easeProgress;

            if (format === 'currency-million') {
                counter.textContent = formatCurrencyMillion(currentValue);
            } else {
                counter.textContent = formatNumber(currentValue);
            }

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                if (format === 'currency-million') {
                    counter.textContent = formatCurrencyMillion(target);
                } else {
                    counter.textContent = formatNumber(target);
                }
            }
        }

        requestAnimationFrame(updateCounter);
    }

    counters.forEach(function (counter) {
        counter.textContent = counter.dataset.format === 'currency-million' ? 'Rp 0Jt' : '0';
        counter.dataset.animated = 'false';
    });

    const counterObserver = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.35,
    });

    counters.forEach(function (counter) {
        counterObserver.observe(counter);
    });
}

/* =========================
   ADMIN SIDEBAR TOGGLE
   ========================= */

document.addEventListener('DOMContentLoaded', function () {
    const adminLayout = document.getElementById('adminLayout');
    const adminMenuToggle = document.getElementById('adminMenuToggle');
    const adminOverlay = document.getElementById('adminOverlay');
    const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');

    if (!adminLayout) {
        return;
    }

    function isMobileView() {
        return window.innerWidth <= 1024;
    }

    function openSidebar() {
        adminLayout.classList.add('sidebar-open');
    }

    function closeSidebar() {
        adminLayout.classList.remove('sidebar-open');
    }

    function toggleMobileSidebar() {
        if (adminLayout.classList.contains('sidebar-open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    }

    function toggleDesktopSidebar() {
        adminLayout.classList.toggle('sidebar-collapsed');
    }

    if (adminMenuToggle) {
        adminMenuToggle.addEventListener('click', function () {
            toggleMobileSidebar();
        });
    }

    if (adminOverlay) {
        adminOverlay.addEventListener('click', function () {
            closeSidebar();
        });
    }

    if (sidebarCollapseBtn) {
        sidebarCollapseBtn.addEventListener('click', function () {
            if (isMobileView()) {
                closeSidebar();
            } else {
                toggleDesktopSidebar();
            }
        });
    }

    window.addEventListener('resize', function () {
        if (!isMobileView()) {
            closeSidebar();
        }
    });
});