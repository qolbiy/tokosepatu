# Sistem Data Warehouse Toko Sepatu

Sistem Data Warehouse Toko Sepatu adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk mengelola data operasional toko sepatu, menjalankan proses ETL, menyimpan data ke dalam data warehouse, serta menampilkan laporan analisis penjualan dalam bentuk grafik dan tabel.

Project ini dibuat sebagai tugas mata kuliah Data Warehouse Semester 8.

---

## Informasi Project

| Keterangan     | Detail                                               |
| -------------- | ---------------------------------------------------- |
| Nama Project   | Sistem Data Warehouse Toko Sepatu                    |
| Jenis Aplikasi | Aplikasi Web Data Warehouse                          |
| Framework      | Laravel                                              |
| Database       | MySQL                                                |
| Mata Kuliah    | Data Warehouse                                       |
| Semester       | 8                                                    |
| Pengembang     | Nayuda Gigih Fayruz Qolbiy, Mukhlis Annas Faturahman |

---

## Deskripsi Project

Sistem ini dirancang untuk membantu admin toko sepatu dalam mengelola data operasional seperti data pelanggan, kategori, produk, dan transaksi. Data operasional tersebut kemudian diproses melalui tahapan ETL (Extract, Transform, Load) dan dimasukkan ke dalam data warehouse.

Data warehouse pada sistem ini menggunakan model Star Schema, dengan tabel fakta sebagai pusat analisis dan tabel dimensi sebagai pendukung analisis. Data hasil ETL digunakan untuk menampilkan dashboard, laporan penjualan, grafik pendapatan, produk terlaris, kategori terlaris, dan ringkasan penjualan.

---

## Tujuan Project

Tujuan dari project ini adalah:

1. Membangun sistem pengelolaan data toko sepatu berbasis web.
2. Menerapkan konsep database operasional dan data warehouse.
3. Membuat proses ETL dari data operasional ke data warehouse.
4. Menerapkan model Star Schema pada sistem toko sepatu.
5. Menampilkan laporan analisis dalam bentuk tabel dan grafik.
6. Membantu proses pemantauan performa toko sepatu berdasarkan data.

---

## Fitur Utama

### 1. Landing Page

Landing page digunakan sebagai halaman awal untuk memperkenalkan sistem data warehouse toko sepatu.

Fitur landing page meliputi:

* Beranda.
* Fitur sistem.
* Alur sistem.
* Star Schema.
* Preview laporan.
* Login admin.
* Ringkasan data dinamis dari database.
* Grafik dan tabel monitoring performa toko.

---

### 2. Authentication Admin

Sistem menggunakan Laravel Breeze untuk fitur autentikasi admin.

Fitur authentication meliputi:

* Register admin.
* Login admin.
* Logout admin.
* Proteksi halaman dashboard.
* Custom tampilan login dan register.

---

### 3. Dashboard Admin

Dashboard digunakan untuk menampilkan ringkasan utama sistem.

Informasi yang ditampilkan:

* Total pelanggan.
* Total kategori.
* Total produk.
* Total transaksi.
* Total pendapatan.
* Produk terjual.
* Grafik pendapatan bulanan.
* Insight cepat.
* Transaksi terbaru.

---

### 4. CRUD Data Operasional

Sistem menyediakan fitur CRUD untuk mengelola data operasional toko sepatu.

Data yang dikelola:

* Data Pelanggan.
* Data Kategori.
* Data Produk.
* Data Transaksi.

Setiap halaman CRUD dilengkapi dengan fitur pencarian agar admin dapat menemukan data dengan lebih cepat.

---

### 5. Proses ETL

ETL merupakan proses pemindahan data dari database operasional ke data warehouse.

Tahapan ETL:

* Extract: mengambil data dari tabel operasional.
* Transform: mengubah data menjadi bentuk dimensi dan fakta.
* Load: memasukkan data ke tabel data warehouse.

Data operasional yang digunakan:

* pelanggans
* kategoris
* produks
* transaksis
* detail_transaksis

Data hasil ETL disimpan ke:

* dim_pelanggans
* dim_kategoris
* dim_produks
* dim_waktus
* fact_penjualans

---

### 6. Data Warehouse

Data warehouse digunakan untuk menyimpan data hasil ETL agar siap dianalisis.

Model yang digunakan adalah Star Schema.

Struktur utama data warehouse:

```text
                 dim_pelanggans
                       |
dim_produks ---- fact_penjualans ---- dim_kategoris
                       |
                  dim_waktus
```

Tabel fakta:

* fact_penjualans

Tabel dimensi:

* dim_pelanggans
* dim_kategoris
* dim_produks
* dim_waktus

---

### 7. Laporan Analisis

Laporan digunakan untuk menampilkan hasil analisis dari data warehouse.

Informasi yang ditampilkan:

* Total pendapatan.
* Total transaksi.
* Produk terjual.
* Rata-rata transaksi.
* Grafik pendapatan bulanan.
* Grafik kategori terlaris.
* Grafik produk terlaris.
* Tabel produk terlaris.
* Tabel ringkasan penjualan.

Fitur filter laporan:

* Filter bulan.
* Filter tahun.

---

## Teknologi yang Digunakan

| Teknologi      | Fungsi                                  |
| -------------- | --------------------------------------- |
| Laravel        | Framework utama aplikasi web            |
| PHP            | Bahasa pemrograman backend              |
| MySQL          | Database operasional dan data warehouse |
| Blade Template | Template tampilan Laravel               |
| Laravel Breeze | Authentication admin                    |
| Vite           | Asset bundling                          |
| CSS            | Styling tampilan                        |
| Tailwind CSS   | Utility styling                         |
| Chart.js       | Visualisasi grafik                      |
| AOS Animation  | Animasi landing page                    |

---

## Struktur Folder Project

```text
project-laravel/
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
├── public/
├── PRD.md
├── README.md
└── .env
```

---

## Instalasi Project

Ikuti langkah berikut untuk menjalankan project secara lokal.

### 1. Clone Repository

```bash
git clone <url-repository>
```

### 2. Masuk ke Folder Project

```bash
cd nama-folder-project
```

### 3. Install Dependency Laravel

```bash
composer install
```

### 4. Install Dependency Node.js

```bash
npm install
```

### 5. Copy File Environment

```bash
cp .env.example .env
```

Jika menggunakan Windows Command Prompt:

```bash
copy .env.example .env
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Konfigurasi Database

Buka file `.env`, lalu sesuaikan konfigurasi database:

```env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Jalankan Migration dan Seeder

```bash
php artisan migrate --seed
```

### 9. Jalankan Server Laravel

```bash
php artisan serve
```

### 10. Jalankan Vite

Buka terminal baru, lalu jalankan:

```bash
npm run dev
```

### 11. Buka Project di Browser

```text
http://127.0.0.1:8000
```

---

## Alur Penggunaan Sistem

1. Admin membuka landing page.
2. Admin login ke dashboard.
3. Admin mengelola data pelanggan, kategori, produk, dan transaksi.
4. Admin menjalankan proses ETL.
5. Sistem memindahkan data operasional ke data warehouse.
6. Admin melihat data warehouse.
7. Admin melihat dashboard dan laporan analisis.
8. Admin dapat memfilter laporan berdasarkan bulan dan tahun.

---

## Catatan Penggunaan

* Jalankan proses ETL setelah menambah atau mengubah data transaksi agar data warehouse dan laporan ikut diperbarui.
* Data dashboard dan laporan yang berbasis data warehouse akan mengikuti hasil proses ETL terakhir.
* Jika stok produk tidak mencukupi, transaksi tidak dapat disimpan dengan status selesai.
* Pastikan `npm run dev` berjalan agar styling, animasi, dan chart dapat tampil dengan benar.

---

## Akun Admin

Jika project menggunakan seeder user/admin, isi akun dapat disesuaikan dengan data seeder yang digunakan.

Contoh format:

```text
Email    : admin@example.com
Password : password
```

Jika tidak menggunakan seeder admin, admin dapat melakukan register melalui halaman register.

---

## Dokumentasi Tambahan

Project ini juga dilengkapi dengan dokumen PRD yang menjelaskan kebutuhan sistem secara lebih detail.

File dokumentasi:

```text
PRD.md
```

---

## Tim Pengembang

Project ini dikembangkan oleh:

1. Nayuda Gigih Fayruz Qolbiy
2. Mukhlis Annas Faturahman

---

## Kesimpulan

Sistem Data Warehouse Toko Sepatu ini dibangun untuk membantu proses pengelolaan data operasional dan analisis penjualan toko sepatu. Dengan adanya proses ETL, model Star Schema, dashboard, grafik, tabel laporan, search, dan filter, sistem ini dapat mendukung pemantauan performa toko secara lebih efektif dan berbasis data.
