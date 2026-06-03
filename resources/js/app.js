import './bootstrap';
import AOS from 'aos';
import Chart from 'chart.js/auto';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

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
    let speed = 0.35;
    let targetSpeed = 0.35;
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
        targetSpeed = 0.35;
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

/*
|--------------------------------------------------------------------------
| Landing Product Toggle Animation
|--------------------------------------------------------------------------
| Mengatur tombol Lihat Semua Produk dan Sembunyikan Produk pada landing page.
| Produk tambahan akan muncul dan hilang dengan animasi smooth.
*/

document.addEventListener('DOMContentLoaded', function () {
    const productToggleButton = document.getElementById('productToggleButton');
    const hiddenProducts = document.querySelectorAll('.shop-product-card.product-hidden');

    if (!productToggleButton || hiddenProducts.length === 0) {
        return;
    }

    let isExpanded = false;

    hiddenProducts.forEach(function (product) {
        product.style.display = 'none';
        product.style.opacity = '0';
        product.style.transform = 'translateY(18px)';
        product.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
    });

    productToggleButton.addEventListener('click', function () {
        isExpanded = !isExpanded;

        if (isExpanded) {
            hiddenProducts.forEach(function (product, index) {
                product.style.display = 'block';

                setTimeout(function () {
                    product.style.opacity = '1';
                    product.style.transform = 'translateY(0)';
                }, index * 55);
            });

            productToggleButton.textContent = 'Sembunyikan Produk';
        } else {
            hiddenProducts.forEach(function (product, index) {
                setTimeout(function () {
                    product.style.opacity = '0';
                    product.style.transform = 'translateY(18px)';
                }, index * 35);
            });

            setTimeout(function () {
                hiddenProducts.forEach(function (product) {
                    product.style.display = 'none';
                });

                productToggleButton.textContent = 'Lihat Semua Produk';

                const produkSection = document.getElementById('produk');

                if (produkSection) {
                    produkSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });
                }
            }, hiddenProducts.length * 35 + 350);
        }
    });
});

/*
|--------------------------------------------------------------------------
| Landing Product Section Scroll Handler
|--------------------------------------------------------------------------
| Mengatur posisi halaman ketika pengguna melakukan filter produk, reset filter,
| atau kembali dari halaman detail produk ke section produk landing page.
| Tujuannya agar halaman langsung berada pada section produk tanpa efek scroll
| pelan dari bagian beranda.
*/

document.addEventListener('DOMContentLoaded', function () {
    const productFilterForm = document.getElementById('productFilterForm');
    const productFilterReset = document.getElementById('productFilterReset');
    const backToProductSection = document.getElementById('backToProductSection');

    if (productFilterForm) {
        productFilterForm.addEventListener('submit', function () {
            sessionStorage.setItem('goToProductSectionInstantly', 'true');
        });
    }

    if (productFilterReset) {
        productFilterReset.addEventListener('click', function () {
            sessionStorage.setItem('goToProductSectionInstantly', 'true');
        });
    }

    if (backToProductSection) {
        backToProductSection.addEventListener('click', function () {
            sessionStorage.setItem('goToProductSectionInstantly', 'true');
        });
    }

    const shouldGoToProductSection = sessionStorage.getItem('goToProductSectionInstantly');

    if (shouldGoToProductSection === 'true' && window.location.hash === '#produk') {
        sessionStorage.removeItem('goToProductSectionInstantly');

        const produkSection = document.getElementById('produk');

        if (produkSection) {
            document.documentElement.style.scrollBehavior = 'auto';
            document.body.style.scrollBehavior = 'auto';

            produkSection.scrollIntoView({
                behavior: 'auto',
                block: 'start',
            });

            setTimeout(function () {
                document.documentElement.style.scrollBehavior = '';
                document.body.style.scrollBehavior = '';
            }, 300);
        }
    }
});
/* =========================
   LANDING CHECKOUT MODAL WITH SWEETALERT2
   ========================= */

document.addEventListener('DOMContentLoaded', function () {
    const checkoutButtons = document.querySelectorAll('.js-checkout-button');

    const checkoutModal = document.getElementById('checkoutModal');
    const checkoutModalClose = document.getElementById('checkoutModalClose');
    const checkoutModalOverlay = document.querySelector('#checkoutModal .checkout-modal-overlay');

    const checkoutProductId = document.getElementById('checkoutProductId');
    const checkoutProductImage = document.getElementById('checkoutProductImage');
    const checkoutProductName = document.getElementById('checkoutProductName');
    const checkoutProductBrand = document.getElementById('checkoutProductBrand');
    const checkoutProductPrice = document.getElementById('checkoutProductPrice');
    const checkoutProductStock = document.getElementById('checkoutProductStock');

    const checkoutCustomerName = document.getElementById('checkoutCustomerName');
    const checkoutCustomerEmail = document.getElementById('checkoutCustomerEmail');
    const checkoutCustomerPhone = document.getElementById('checkoutCustomerPhone');
    const checkoutCustomerGender = document.getElementById('checkoutCustomerGender');
    const checkoutCustomerAddress = document.getElementById('checkoutCustomerAddress');

    const checkoutShoeSize = document.getElementById('checkoutShoeSize');
    const checkoutQuantity = document.getElementById('checkoutQuantity');
    const checkoutPayment = document.getElementById('checkoutPayment');
    const checkoutTotalPrice = document.getElementById('checkoutTotalPrice');
    const checkoutSubmitButton = document.getElementById('checkoutSubmitButton');

    const paymentMethodCards = document.querySelectorAll('.payment-method-card');
    const paymentInfoItems = document.querySelectorAll('.payment-info-item');

    if (!checkoutButtons.length || !checkoutModal) {
        return;
    }

    let selectedProductPrice = 0;
    let selectedProductStock = 0;

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(value || 0);
    }

    function setPaymentMethod(method) {
        if (checkoutPayment) {
            checkoutPayment.value = method;
        }

        paymentMethodCards.forEach(function (card) {
            if (card.dataset.paymentMethod === method) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });

        paymentInfoItems.forEach(function (item) {
            if (item.dataset.paymentInfo === method) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    }

    function renderShoeSizes(productSize) {
        if (!checkoutShoeSize) {
            return;
        }

        checkoutShoeSize.innerHTML = '<option value="">Pilih ukuran</option>';

        let sizes = [];

        if (productSize.includes('-')) {
            const sizeRange = productSize.split('-');
            const startSize = Number(sizeRange[0]);
            const endSize = Number(sizeRange[1]);

            if (!Number.isNaN(startSize) && !Number.isNaN(endSize) && startSize <= endSize) {
                for (let size = startSize; size <= endSize; size++) {
                    sizes.push(String(size));
                }
            }
        } else {
            sizes = productSize
                .split(',')
                .map(function (size) {
                    return size.trim();
                })
                .filter(function (size) {
                    return size !== '';
                });
        }

        if (sizes.length > 0) {
            sizes.forEach(function (size) {
                const option = document.createElement('option');
                option.value = size;
                option.textContent = size;
                checkoutShoeSize.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'Ukuran tidak tersedia';
            checkoutShoeSize.appendChild(option);
        }
    }

    function updateTotalPrice() {
        if (!checkoutQuantity || !checkoutTotalPrice) {
            return;
        }

        let quantity = Number(checkoutQuantity.value);

        if (quantity < 1 || Number.isNaN(quantity)) {
            quantity = 1;
            checkoutQuantity.value = 1;
        }

        if (selectedProductStock > 0 && quantity > selectedProductStock) {
            quantity = selectedProductStock;
            checkoutQuantity.value = selectedProductStock;
        }

        checkoutTotalPrice.textContent = formatRupiah(selectedProductPrice * quantity);
    }

    function openCheckoutModal(button) {
        const productId = button.dataset.id || '';
        const productName = button.dataset.nama || 'Produk';
        const productBrand = button.dataset.merek || '-';
        const productPrice = Number(button.dataset.harga || 0);
        const productStock = Number(button.dataset.stok || 0);
        const productSize = button.dataset.ukuran || '';
        const productImage = button.dataset.foto || '';

        selectedProductPrice = productPrice;
        selectedProductStock = productStock;

        if (checkoutProductId) {
            checkoutProductId.value = productId;
        }

        if (checkoutProductImage) {
            checkoutProductImage.src = productImage;
            checkoutProductImage.alt = productName;
        }

        if (checkoutProductName) {
            checkoutProductName.textContent = productName;
        }

        if (checkoutProductBrand) {
            checkoutProductBrand.textContent = productBrand;
        }

        if (checkoutProductPrice) {
            checkoutProductPrice.textContent = formatRupiah(productPrice);
        }

        if (checkoutProductStock) {
            checkoutProductStock.textContent = `Stok ${productStock}`;
        }

        if (checkoutQuantity) {
            checkoutQuantity.value = 1;
            checkoutQuantity.min = 1;
            checkoutQuantity.max = productStock;
        }

        if (checkoutTotalPrice) {
            checkoutTotalPrice.textContent = formatRupiah(productPrice);
        }

        renderShoeSizes(productSize);
        setPaymentMethod('COD');

        checkoutModal.classList.add('show');
        checkoutModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');
    }

    function closeCheckoutModal() {
        checkoutModal.classList.remove('show');
        checkoutModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
    }

    function showWarning(message, inputElement = null) {
        Swal.fire({
            icon: 'warning',
            title: 'Data Belum Lengkap',
            text: message,
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#8b5cf6',
        }).then(function () {
            if (inputElement) {
                inputElement.focus();
            }
        });
    }

    checkoutButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openCheckoutModal(button);
        });
    });

    if (checkoutModalClose) {
        checkoutModalClose.addEventListener('click', closeCheckoutModal);
    }

    if (checkoutModalOverlay) {
        checkoutModalOverlay.addEventListener('click', closeCheckoutModal);
    }

    if (checkoutQuantity) {
        checkoutQuantity.addEventListener('input', updateTotalPrice);
        checkoutQuantity.addEventListener('change', updateTotalPrice);
    }

    if (paymentMethodCards.length > 0) {
        paymentMethodCards.forEach(function (card) {
            card.addEventListener('click', function () {
                const selectedMethod = card.dataset.paymentMethod;
                setPaymentMethod(selectedMethod);
            });
        });
    }

    if (checkoutSubmitButton) {
        checkoutSubmitButton.addEventListener('click', function (event) {
            event.preventDefault();

            const customerName = checkoutCustomerName ? checkoutCustomerName.value.trim() : '';
            const customerEmail = checkoutCustomerEmail ? checkoutCustomerEmail.value.trim() : '';
            const customerPhone = checkoutCustomerPhone ? checkoutCustomerPhone.value.trim() : '';
            const customerGender = checkoutCustomerGender ? checkoutCustomerGender.value : '';
            const customerAddress = checkoutCustomerAddress ? checkoutCustomerAddress.value.trim() : '';
            const shoeSize = checkoutShoeSize ? checkoutShoeSize.value : '';
            const quantity = checkoutQuantity ? Number(checkoutQuantity.value) : 1;
            const paymentMethod = checkoutPayment ? checkoutPayment.value : 'COD';
            const productName = checkoutProductName ? checkoutProductName.textContent : 'Produk';
            const totalPrice = checkoutTotalPrice ? checkoutTotalPrice.textContent : 'Rp 0';

            if (!customerName) {
                showWarning('Nama pembeli wajib diisi.', checkoutCustomerName);
                return;
            }

            if (!customerEmail) {
                showWarning('Email pembeli wajib diisi.', checkoutCustomerEmail);
                return;
            }

            if (!customerPhone) {
                showWarning('Nomor WhatsApp wajib diisi.', checkoutCustomerPhone);
                return;
            }

            if (!customerGender) {
                showWarning('Jenis kelamin wajib dipilih.', checkoutCustomerGender);
                return;
            }

            if (!customerAddress) {
                showWarning('Alamat pembeli wajib diisi.', checkoutCustomerAddress);
                return;
            }

            if (!shoeSize) {
                showWarning('Ukuran sepatu wajib dipilih.', checkoutShoeSize);
                return;
            }

            if (quantity < 1 || Number.isNaN(quantity)) {
                showWarning('Jumlah pembelian tidak valid.', checkoutQuantity);
                return;
            }

            if (selectedProductStock > 0 && quantity > selectedProductStock) {
                showWarning('Jumlah pembelian melebihi stok yang tersedia.', checkoutQuantity);
                return;
            }

            Swal.fire({
                icon: 'question',
                title: 'Lanjutkan Pembelian?',
                html: `
                    <div style="text-align:left;line-height:1.8">
                        <strong>Nama:</strong> ${customerName}<br>
                        <strong>Email:</strong> ${customerEmail}<br>
                        <strong>No. WhatsApp:</strong> ${customerPhone}<br>
                        <strong>Jenis Kelamin:</strong> ${customerGender}<br>
                        <strong>Alamat:</strong> ${customerAddress}<br>
                        <strong>Produk:</strong> ${productName}<br>
                        <strong>Ukuran:</strong> ${shoeSize}<br>
                        <strong>Jumlah:</strong> ${quantity} Produk<br>
                        <strong>Pembayaran:</strong> ${paymentMethod}<br>
                        <strong>Total:</strong> ${totalPrice}
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#8b5cf6',
                cancelButtonColor: '#64748b',
                reverseButtons: true,
            }).then(function (result) {
                if (result.isConfirmed) {
                    const checkoutForm = document.getElementById('checkoutForm');

                    if (checkoutForm) {
                        checkoutForm.submit();
                    }
                }
            });
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && checkoutModal.classList.contains('show')) {
            closeCheckoutModal();
        }
    });
});

/* =========================
   CHECKOUT SESSION ALERT
   ========================= */

document.addEventListener('DOMContentLoaded', function () {
    const checkoutSessionAlert = document.getElementById('checkoutSessionAlert');

    if (!checkoutSessionAlert) {
        return;
    }

    const successMessage = checkoutSessionAlert.dataset.success;
const errorMessage = checkoutSessionAlert.dataset.error;
const validationErrorMessage = checkoutSessionAlert.dataset.validationError;

    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Pesanan Berhasil',
            text: successMessage,
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#8b5cf6',
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Pesanan Gagal',
            text: errorMessage,
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#8b5cf6',
        });
    }

    if (validationErrorMessage) {
    Swal.fire({
        icon: 'warning',
        title: 'Data Checkout Belum Valid',
        text: validationErrorMessage,
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#8b5cf6',
    });
}
});
/* =========================
   CONFIRM TRANSACTION ALERT
   ========================= */

document.addEventListener('DOMContentLoaded', function () {
    const confirmForms = document.querySelectorAll('.confirm-form');

    if (!confirmForms.length) {
        return;
    }

    confirmForms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi Transaksi?',
                text: 'Status transaksi akan diubah dari Pending menjadi Selesai.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Konfirmasi',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#64748b',
                reverseButtons: true,
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
/* =========================
   TESTIMONIAL MARQUEE CURSOR CONTROL
   ========================= */

document.addEventListener('DOMContentLoaded', function () {
    const testimonialMarquee = document.querySelector('.testimonial-marquee');
    const testimonialTrack = document.querySelector('.testimonial-track');

    if (!testimonialMarquee || !testimonialTrack) {
        return;
    }

    let position = 0;
    let speed = -0.35;
    let targetSpeed = -0.35;
    let lastMouseX = null;
    let isHovering = false;

    function getLoopWidth() {
        return testimonialTrack.scrollWidth / 2;
    }

    function animateTestimonialMarquee() {
        const loopWidth = getLoopWidth();

        speed += (targetSpeed - speed) * 0.08;
        position += speed;

        if (position <= -loopWidth) {
            position += loopWidth;
        }

        if (position >= 0) {
            position -= loopWidth;
        }

        testimonialTrack.style.transform = `translateX(${position}px)`;

        requestAnimationFrame(animateTestimonialMarquee);
    }

    testimonialMarquee.addEventListener('mouseenter', function (event) {
        isHovering = true;
        lastMouseX = event.clientX;
        targetSpeed = 0;
    });

    testimonialMarquee.addEventListener('mousemove', function (event) {
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

    testimonialMarquee.addEventListener('mouseleave', function () {
        isHovering = false;
        lastMouseX = null;
        targetSpeed = -0.35;
    });

    animateTestimonialMarquee();
});

/* =========================
   CHECKOUT PAYMENT COUNTDOWN AND STATUS POLLING
   ========================= */

document.addEventListener('DOMContentLoaded', function () {
    const countdownBox = document.querySelector('.payment-countdown-box');
    const countdownText = document.getElementById('paymentCountdown');
    const paymentStatusText = document.getElementById('paymentStatusText');

    if (!countdownBox || !countdownText || !paymentStatusText) {
        return;
    }

    const deadlineValue = countdownBox.dataset.deadline;
    const statusUrl = countdownBox.dataset.statusUrl;
    const expiredUrl = countdownBox.dataset.expiredUrl;

    let lastStatus = paymentStatusText.textContent.trim();
    let successAlertShown = false;
    let expiredAlertShown = false;
    let expiredRequestSent = false;
    let countdownInterval = null;
    let statusInterval = null;

    function getCsrfToken() {
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');

        return csrfMeta ? csrfMeta.getAttribute('content') : '';
    }

    function stopIntervals() {
        if (countdownInterval) {
            clearInterval(countdownInterval);
            countdownInterval = null;
        }

        if (statusInterval) {
            clearInterval(statusInterval);
            statusInterval = null;
        }
    }

    function showPaymentSuccessAlert() {
        if (successAlertShown) {
            return;
        }

        successAlertShown = true;

        Swal.fire({
            icon: 'success',
            title: 'Pembayaran Berhasil',
            text: 'Pembayaran berhasil dikonfirmasi oleh admin. Status pesanan Anda sudah Selesai.',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#16a34a',
        });
    }

    function showPaymentExpiredAlert() {
        if (expiredAlertShown) {
            return;
        }

        expiredAlertShown = true;

        Swal.fire({
            icon: 'warning',
            title: 'Pembayaran Expired',
            text: 'Batas waktu pembayaran telah habis. Silakan ulangi pesanan dari halaman produk.',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#f97316',
        });
    }

    function setPaymentAsConfirmed(showAlert = false) {
        stopIntervals();

        lastStatus = 'Selesai';

        paymentStatusText.textContent = 'Selesai';
        paymentStatusText.classList.remove('payment-status-pending');
        paymentStatusText.classList.remove('payment-status-expired');
        paymentStatusText.classList.add('payment-status-success');

        countdownBox.classList.remove('expired');
        countdownBox.classList.add('payment-confirmed');

        countdownText.textContent = 'Lunas';

        const countdownDescription = countdownBox.querySelector('p');

        if (countdownDescription) {
            countdownDescription.textContent = 'Pembayaran sudah dikonfirmasi oleh admin. Pesanan Anda telah berstatus Selesai.';
        }

        if (showAlert) {
            showPaymentSuccessAlert();
        }
    }

    function setPaymentAsExpired(showAlert = false) {
        stopIntervals();

        lastStatus = 'Kadaluarsa';

        paymentStatusText.textContent = 'Kadaluarsa';
        paymentStatusText.classList.remove('payment-status-pending');
        paymentStatusText.classList.remove('payment-status-success');
        paymentStatusText.classList.add('payment-status-expired');

        countdownBox.classList.remove('payment-confirmed');
        countdownBox.classList.add('expired');

        countdownText.textContent = '00:00';

        const countdownDescription = countdownBox.querySelector('p');

        if (countdownDescription) {
            countdownDescription.textContent = 'Batas waktu pembayaran telah habis. Silakan ulangi pesanan dari halaman produk.';
        }

        if (showAlert) {
            showPaymentExpiredAlert();
        }
    }

    function markPaymentAsExpired() {
        if (!expiredUrl || expiredRequestSent || lastStatus !== 'Pending') {
            return;
        }

        expiredRequestSent = true;

        fetch(expiredUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({}),
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data && data.status === 'Kadaluarsa') {
                    setPaymentAsExpired(true);
                    return;
                }

                if (data && data.status === 'Selesai') {
                    setPaymentAsConfirmed(true);
                    return;
                }

                setPaymentAsExpired(true);
            })
            .catch(function () {
                setPaymentAsExpired(true);
            });
    }

    function updateCountdown() {
        if (lastStatus === 'Selesai') {
            setPaymentAsConfirmed(false);
            return;
        }

        if (lastStatus === 'Kadaluarsa') {
            setPaymentAsExpired(false);
            return;
        }

        if (!deadlineValue) {
            countdownText.textContent = '10:00';
            return;
        }

        const deadline = new Date(deadlineValue).getTime();

        if (Number.isNaN(deadline)) {
            countdownText.textContent = '10:00';
            return;
        }

        const now = new Date().getTime();
        const distance = deadline - now;

        if (distance <= 0) {
            countdownText.textContent = '00:00';
            markPaymentAsExpired();
            return;
        }

        const minutes = Math.floor(distance / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownText.textContent =
            String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
    }

    function checkPaymentStatus() {
        if (!statusUrl || lastStatus !== 'Pending') {
            return;
        }

        fetch(statusUrl)
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (!data || !data.status) {
                    return;
                }

                if (data.status === 'Selesai') {
                    setPaymentAsConfirmed(true);
                    return;
                }

                if (data.status === 'Kadaluarsa') {
                    setPaymentAsExpired(true);
                    return;
                }

                lastStatus = data.status;
            })
            .catch(function () {
                // Abaikan error kecil agar halaman tetap aman.
            });
    }

    if (lastStatus === 'Selesai') {
        setPaymentAsConfirmed(false);
        return;
    }

    if (lastStatus === 'Kadaluarsa') {
        setPaymentAsExpired(false);
        return;
    }

    updateCountdown();

    countdownInterval = setInterval(updateCountdown, 1000);
    statusInterval = setInterval(checkPaymentStatus, 8000);
});