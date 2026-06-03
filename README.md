# ShoeDW - Sistem Data Warehouse Toko Sepatu Berbasis Web

ShoeDW adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk mengelola data toko sepatu, mulai dari katalog produk, checkout pembelian, transaksi penjualan, proses ETL, data warehouse, hingga laporan analisis penjualan. Sistem ini memiliki dua sisi utama, yaitu landing page untuk pembeli dan dashboard admin untuk pengelolaan data.

Project ini dibuat sebagai tugas mata kuliah Data Warehouse Semester 8.

---

## Informasi Project

| Keterangan     | Detail                                               |
| -------------- | ---------------------------------------------------- |
| Nama Project   | ShoeDW - Sistem Data Warehouse Toko Sepatu           |
| Jenis Aplikasi | Aplikasi Web Toko Sepatu dan Data Warehouse          |
| Framework      | Laravel                                              |
| Database       | MySQL                                                |
| Mata Kuliah    | Data Warehouse                                       |
| Semester       | 8                                                    |
| Pengembang     | Nayuda Gigih Fayruz Qolbiy, Mukhlis Annas Faturahman |

---

## Deskripsi Project

ShoeDW dirancang untuk membantu pengelolaan toko sepatu berbasis web dengan fitur katalog produk, checkout pembelian, pengelolaan transaksi, dan laporan penjualan. Pada sisi user, sistem menyediakan landing page yang menampilkan produk sepatu, ranking produk terlaris, testimoni pelanggan, serta proses pembelian melalui modal checkout.

Pada sisi admin, sistem menyediakan dashboard dan menu pengelolaan data operasional seperti pelanggan, kategori, produk, dan transaksi. Data transaksi yang sudah selesai kemudian diproses melalui ETL untuk dimasukkan ke dalam data warehouse. Data warehouse menggunakan model Star Schema dengan tabel fakta penjualan sebagai pusat analisis dan tabel dimensi sebagai pendukung.

Hasil ETL digunakan untuk menampilkan dashboard, laporan analisis penjualan, grafik pendapatan, kategori terlaris, produk terlaris, serta ranking produk pada landing page.

---

## Tujuan Project

Tujuan dari project ini adalah:

1. Membangun sistem toko sepatu berbasis web menggunakan Laravel.
2. Mengelola data operasional toko sepatu seperti pelanggan, kategori, produk, dan transaksi.
3. Menyediakan fitur checkout pembelian langsung dari landing page.
4. Menerapkan metode pembayaran COD, Transfer Bank, dan QRIS Simulasi.
5. Menerapkan status transaksi Pending dan Selesai berdasarkan metode pembayaran.
6. Membuat proses ETL dari database operasional ke data warehouse.
7. Menerapkan model Star Schema pada sistem data warehouse toko sepatu.
8. Menampilkan laporan dan ranking produk berdasarkan data transaksi yang sudah selesai.

---

## Fitur Utama

### 1. Landing Page User

Landing page digunakan sebagai halaman utama untuk pembeli. Tampilan landing page dibuat sesuai dengan kebutuhan user toko sepatu, sehingga pembeli dapat melihat produk, mengetahui produk terlaris, membaca testimoni, dan melakukan pembelian secara langsung.

Fitur landing page meliputi:

* Beranda.
* Katalog produk sepatu.
* Filter produk berdasarkan kategori dan merek.
* Detail produk.
* Tombol Beli Sekarang.
* Modal checkout pembelian.
* Ranking produk terlaris.
* Testimoni pelanggan berjalan.
* Informasi teknologi yang digunakan.
* Footer.

---

### 2. Checkout Pembelian

User dapat membeli produk langsung dari landing page melalui tombol Beli Sekarang. Setelah tombol ditekan, sistem akan menampilkan modal checkout berisi informasi produk, data pembeli, jumlah pembelian, metode pembayaran, dan total pembayaran.

Data checkout yang diisi pembeli:

* Nama pembeli.
* Email.
* Nomor WhatsApp.
* Jenis kelamin.
* Alamat.
* Jumlah pembelian.
* Metode pembayaran.

Metode pembayaran yang tersedia:

* COD.
* Transfer Bank.
* QRIS Simulasi.

Aturan status transaksi:

* COD otomatis masuk dengan status Selesai.
* Transfer Bank masuk dengan status Pending.
* QRIS Simulasi masuk dengan status Pending.
* Transaksi Pending dapat dikonfirmasi oleh admin menjadi Selesai.

Saat checkout berhasil, stok produk akan berkurang sesuai jumlah pembelian.

---

### 3. Authentication Admin

Sistem menggunakan Laravel Breeze untuk autentikasi admin. Halaman admin hanya dapat diakses oleh pengguna yang sudah login.

Fitur authentication meliputi:

* Register admin.
* Login admin.
* Logout admin.
* Proteksi halaman dashboard.
* Custom tampilan login dan register.

---

### 4. Dashboard Admin

Dashboard admin digunakan untuk menampilkan ringkasan utama sistem. Dashboard membantu admin melihat kondisi toko secara ringkas berdasarkan data yang tersimpan pada sistem.

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

### 5. CRUD Data Operasional

Sistem menyediakan fitur CRUD untuk mengelola data operasional toko sepatu. Data operasional ini menjadi sumber utama sebelum diproses ke data warehouse.

Data yang dikelola:

* Data Pelanggan.
* Data Kategori.
* Data Produk.
* Data Transaksi.

Setiap halaman CRUD dilengkapi dengan fitur pencarian agar admin dapat menemukan data dengan lebih cepat.

---

### 6. Data Transaksi dan Konfirmasi Pembayaran

Menu Data Transaksi digunakan admin untuk melihat dan mengelola transaksi penjualan yang masuk dari landing page maupun dari input admin.

Fitur Data Transaksi meliputi:

* Menampilkan kode transaksi.
* Menampilkan tanggal transaksi.
* Menampilkan data pelanggan.
* Menampilkan produk yang dibeli.
* Menampilkan jumlah pembelian.
* Menampilkan total harga.
* Menampilkan metode pembayaran.
* Menampilkan badge status Pending dan Selesai.
* Menampilkan tombol Detail, Edit, Konfirmasi, dan Hapus.

Tombol Konfirmasi hanya muncul pada transaksi dengan status Pending. Setelah admin menekan tombol Konfirmasi, status transaksi berubah menjadi Selesai. Proses konfirmasi menggunakan SweetAlert2 agar perubahan status lebih aman dan jelas.

---

### 7. Proses ETL

ETL merupakan proses pemindahan data dari database operasional ke data warehouse. Proses ini digunakan agar data transaksi dapat dianalisis melalui tabel fakta dan tabel dimensi.

Tahapan ETL:

* Extract: mengambil data dari tabel operasional.
* Transform: mengubah data operasional menjadi data dimensi dan fakta.
* Load: memasukkan data hasil transformasi ke tabel data warehouse.

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

Pada sistem ini, proses ETL hanya mengambil transaksi dengan status Selesai. Transaksi dengan status Pending tidak akan masuk ke fact_penjualans sebelum dikonfirmasi oleh admin.

---

### 8. Data Warehouse

Data warehouse digunakan untuk menyimpan data hasil ETL agar siap dianalisis. Model yang digunakan adalah Star Schema, yaitu model data warehouse yang memiliki tabel fakta sebagai pusat analisis dan tabel dimensi sebagai pendukung.

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

### 9. Laporan Analisis

Laporan digunakan untuk menampilkan hasil analisis dari data warehouse. Data yang ditampilkan pada laporan berasal dari hasil proses ETL, sehingga laporan mengikuti data transaksi yang sudah masuk ke fact_penjualans.

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

### 10. Ranking Produk Terlaris

Ranking produk pada landing page diambil dari hasil data warehouse. Ranking ini menampilkan produk sepatu dengan penjualan tertinggi berdasarkan data transaksi yang sudah diproses melalui ETL.

Alur ranking:

```text
Checkout Pembelian
        |
Transaksi Operasional
        |
Status Selesai
        |
Proses ETL
        |
fact_penjualans
        |
Ranking Produk Terlaris
```

Jika transaksi masih berstatus Pending, maka transaksi tersebut belum masuk ke ranking produk.

---

## Teknologi yang Digunakan

| Teknologi      | Fungsi                                               |
| -------------- | ---------------------------------------------------- |
| Laravel        | Framework utama aplikasi web                         |
| PHP            | Bahasa pemrograman backend                           |
| MySQL          | Database operasional dan data warehouse              |
| Blade Template | Template tampilan Laravel                            |
| Laravel Breeze | Authentication admin                                 |
| Vite           | Asset bundling                                       |
| CSS            | Styling tampilan                                     |
| Tailwind CSS   | Utility styling                                      |
| JavaScript     | Interaksi landing page dan dashboard                 |
| Chart.js       | Visualisasi grafik                                   |
| AOS Animation  | Animasi scroll landing page                          |
| SweetAlert2    | Alert checkout, hapus data, dan konfirmasi transaksi |

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
├── public/
│   ├── images/
│   └── storage/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
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
DB_DATABASE=toko_sepatu_dw
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Jalankan Migration dan Seeder

```bash
php artisan migrate --seed
```

### 9. Buat Storage Link

```bash
php artisan storage:link
```

### 10. Jalankan Server Laravel

```bash
php artisan serve
```

### 11. Jalankan Vite

Buka terminal baru, lalu jalankan:

```bash
npm run dev
```

### 12. Buka Project di Browser

```text
http://127.0.0.1:8000
```

---

## Alur Penggunaan Sistem

### Alur User

1. User membuka landing page.
2. User melihat daftar produk sepatu.
3. User memfilter produk berdasarkan kategori atau merek.
4. User melihat detail produk.
5. User menekan tombol Beli Sekarang.
6. User mengisi data checkout.
7. User memilih metode pembayaran.
8. Sistem menyimpan transaksi dan mengurangi stok produk.

### Alur Admin

1. Admin login ke dashboard.
2. Admin mengelola data pelanggan, kategori, produk, dan transaksi.
3. Admin mengecek transaksi yang masuk.
4. Admin mengonfirmasi transaksi Pending jika pembayaran sudah dianggap valid.
5. Admin menjalankan proses ETL.
6. Sistem memindahkan data transaksi Selesai ke data warehouse.
7. Admin melihat data warehouse, dashboard, dan laporan analisis.
8. Ranking produk pada landing page diperbarui berdasarkan hasil ETL.

---

## Alur Status Transaksi

```text
COD
 |
 v
Selesai
 |
 v
Masuk ETL dan Ranking

Transfer Bank / QRIS Simulasi
 |
 v
Pending
 |
 v
Konfirmasi Admin
 |
 v
Selesai
 |
 v
Masuk ETL dan Ranking
```

---

## Catatan Penggunaan

* Jalankan proses ETL setelah ada transaksi Selesai agar data warehouse, laporan, dan ranking landing ikut diperbarui.
* Transaksi Pending tidak akan masuk ke data warehouse sebelum dikonfirmasi admin.
* Jika stok produk tidak mencukupi, transaksi tidak dapat disimpan.
* Pastikan `npm run dev` berjalan agar styling, animasi, SweetAlert2, dan chart dapat tampil dengan benar.
* Pastikan `php artisan storage:link` sudah dijalankan agar gambar produk dari storage dapat tampil.
* Untuk metode Transfer Bank dan QRIS Simulasi, transaksi akan masuk sebagai Pending dan perlu dikonfirmasi admin.

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

ShoeDW adalah sistem toko sepatu berbasis web yang menggabungkan fitur katalog produk, checkout pembelian, manajemen transaksi, proses ETL, data warehouse, dan laporan analisis penjualan. Dengan adanya alur status transaksi, konfirmasi pembayaran, serta proses ETL yang hanya memproses transaksi Selesai, sistem ini dapat menghasilkan data warehouse dan ranking produk yang lebih valid. Sistem ini juga membantu admin dalam memantau performa toko berdasarkan data penjualan yang telah diproses.
