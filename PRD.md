# Product Requirements Document (PRD)

## Sistem Data Warehouse Toko Sepatu

---

## 1. Informasi Dokumen

| Keterangan    | Detail                                               |
| ------------- | ---------------------------------------------------- |
| Nama Project  | Sistem Data Warehouse Toko Sepatu                    |
| Jenis Project | Aplikasi Web Data Warehouse                          |
| Framework     | Laravel                                              |
| Database      | MySQL                                                |
| Mata Kuliah   | Data Warehouse                                       |
| Semester      | 8                                                    |
| Pengembang    | Nayuda Gigih Fayruz Qolbiy, Mukhlis Annas Faturahman |
| Versi Dokumen | 1.0                                                  |

---

## 2. Ringkasan Project

Sistem Data Warehouse Toko Sepatu adalah aplikasi berbasis web yang digunakan untuk mengelola data operasional toko sepatu, menjalankan proses ETL, menyimpan data hasil transformasi ke dalam data warehouse, serta menampilkan laporan analisis penjualan dalam bentuk grafik dan tabel.

Sistem ini dibangun untuk membantu admin dalam memantau performa toko sepatu berdasarkan data transaksi, produk, kategori, pelanggan, dan waktu. Data operasional yang awalnya tersimpan dalam tabel transaksi diolah melalui proses ETL menjadi bentuk data warehouse dengan model Star Schema.

---

## 3. Latar Belakang

Dalam kegiatan penjualan toko sepatu, data transaksi, produk, kategori, dan pelanggan terus bertambah dari waktu ke waktu. Jika data hanya disimpan sebagai data operasional, proses analisis seperti mengetahui produk terlaris, kategori terlaris, pendapatan bulanan, dan tren penjualan menjadi kurang efisien.

Oleh karena itu, dibutuhkan sistem data warehouse yang mampu mengolah data operasional menjadi data analisis. Dengan adanya proses ETL dan model Star Schema, data dapat disusun menjadi lebih terstruktur sehingga memudahkan proses pelaporan dan pengambilan keputusan.

---

## 4. Tujuan Project

Tujuan dari sistem ini adalah:

1. Membangun aplikasi web untuk mengelola data operasional toko sepatu.
2. Menerapkan proses ETL dari database operasional ke data warehouse.
3. Menerapkan model Star Schema pada data warehouse.
4. Menyediakan dashboard admin yang menampilkan ringkasan data utama.
5. Menyediakan laporan analisis penjualan dalam bentuk grafik dan tabel.
6. Membantu admin dalam memantau performa toko sepatu berdasarkan data.

---

## 5. Pengguna Sistem

### 5.1 Admin

Admin adalah pengguna utama sistem. Admin memiliki hak akses untuk:

* Login ke dashboard.
* Mengelola data pelanggan.
* Mengelola data kategori.
* Mengelola data produk.
* Mengelola data transaksi.
* Menjalankan proses ETL.
* Melihat data warehouse.
* Melihat laporan analisis.
* Melihat dashboard performa toko.

---

## 6. Ruang Lingkup Sistem

Sistem mencakup beberapa modul utama:

1. Landing Page
2. Authentication Admin
3. Dashboard Admin
4. CRUD Data Pelanggan
5. CRUD Data Kategori
6. CRUD Data Produk
7. CRUD Data Transaksi
8. Proses ETL
9. Data Warehouse
10. Laporan Analisis
11. Search dan Filter Data

---

## 7. Fitur Sistem

## 7.1 Landing Page

Landing page berfungsi sebagai halaman awal untuk memperkenalkan sistem data warehouse toko sepatu.

### Menu Landing Page

* Beranda
* Fitur
* Alur Sistem
* Star Schema
* Laporan
* Login Admin

### Informasi yang Ditampilkan

* Deskripsi sistem data warehouse toko sepatu.
* Total produk.
* Total kategori.
* Total transaksi.
* Total pendapatan.
* Produk terlaris.
* Grafik penjualan bulanan.
* Grafik kategori terlaris.
* Grafik produk terlaris.
* Tabel ranking produk terlaris.

### Tujuan Landing Page

Landing page digunakan untuk memberikan gambaran umum tentang sistem, fitur utama, alur kerja, model data warehouse, dan hasil laporan analisis.

---

## 7.2 Authentication Admin

Sistem menggunakan Laravel Breeze untuk fitur autentikasi.

### Fitur Authentication

* Register admin.
* Login admin.
* Logout admin.
* Proteksi halaman dashboard.
* Custom tampilan login.
* Custom tampilan register.

### Aturan Authentication

* Halaman dashboard hanya dapat diakses oleh admin yang sudah login.
* Admin yang belum login akan diarahkan ke halaman login.
* Setelah login, admin dapat mengakses fitur pengelolaan data dan laporan.

---

## 7.3 Dashboard Admin

Dashboard digunakan untuk menampilkan ringkasan data utama dari sistem.

### Informasi Dashboard

* Total pelanggan.
* Total kategori.
* Total produk.
* Total transaksi.
* Total pendapatan.
* Produk terjual.
* Grafik pendapatan bulanan.
* Insight cepat.
* Transaksi terbaru.

### Sumber Data Dashboard

Dashboard mengambil data dari:

* Database operasional.
* Data warehouse hasil proses ETL.

### Tujuan Dashboard

Dashboard membantu admin melihat kondisi umum toko secara cepat melalui angka ringkasan, grafik, dan data transaksi terbaru.

---

## 7.4 Data Pelanggan

Modul Data Pelanggan digunakan untuk mengelola data pelanggan toko sepatu.

### Fitur Data Pelanggan

* Menampilkan daftar pelanggan.
* Menambah data pelanggan.
* Mengubah data pelanggan.
* Menghapus data pelanggan.
* Melihat detail pelanggan.
* Search data pelanggan.

### Data yang Dikelola

* Nama pelanggan.
* Email.
* Nomor HP.
* Alamat.
* Jenis kelamin.

### Search Data Pelanggan

Admin dapat mencari data pelanggan berdasarkan:

* Nama pelanggan.
* Email.
* Nomor HP.
* Alamat.
* Jenis kelamin.

---

## 7.5 Data Kategori

Modul Data Kategori digunakan untuk mengelola kategori produk sepatu.

### Fitur Data Kategori

* Menampilkan daftar kategori.
* Menambah data kategori.
* Mengubah data kategori.
* Menghapus data kategori.
* Search data kategori.

### Data yang Dikelola

* Kode kategori.
* Nama kategori.
* Deskripsi.

### Search Data Kategori

Admin dapat mencari data kategori berdasarkan:

* Kode kategori.
* Nama kategori.
* Deskripsi.

---

## 7.6 Data Produk

Modul Data Produk digunakan untuk mengelola data produk sepatu.

### Fitur Data Produk

* Menampilkan daftar produk.
* Menambah data produk.
* Mengubah data produk.
* Menghapus data produk.
* Melihat detail produk.
* Search data produk.

### Data yang Dikelola

* Nama produk.
* Kategori produk.
* Merek.
* Ukuran.
* Warna.
* Harga beli.
* Harga jual.
* Stok.

### Search Data Produk

Admin dapat mencari data produk berdasarkan:

* Nama produk.
* Kategori.
* Merek.
* Ukuran.
* Warna.
* Stok.
* Harga jual.

### Validasi Produk

* Produk harus memiliki kategori.
* Harga jual dan harga beli harus berupa angka.
* Stok produk tidak boleh bernilai negatif.

---

## 7.7 Data Transaksi

Modul Data Transaksi digunakan untuk mencatat dan mengelola transaksi penjualan sepatu.

### Fitur Data Transaksi

* Menampilkan daftar transaksi.
* Menambah transaksi.
* Mengubah transaksi.
* Menghapus transaksi.
* Melihat detail transaksi.
* Search data transaksi.
* Validasi stok produk.

### Data yang Dikelola

* Kode transaksi.
* Pelanggan.
* Produk.
* Jumlah beli.
* Harga satuan.
* Subtotal.
* Total harga.
* Tanggal transaksi.
* Status transaksi.

### Search Data Transaksi

Admin dapat mencari data transaksi berdasarkan:

* Kode transaksi.
* Nama pelanggan.
* Nama produk.
* Tanggal transaksi.
* Status transaksi.

### Validasi Transaksi

* Transaksi tidak dapat disimpan jika stok produk tidak mencukupi.
* Jika transaksi berstatus selesai, stok produk akan berkurang.
* Produk dengan stok kosong tidak dapat dipilih untuk transaksi selesai.

---

## 8. Proses ETL

ETL adalah proses Extract, Transform, Load yang digunakan untuk memindahkan data dari database operasional ke data warehouse.

---

## 8.1 Extract

Tahap Extract adalah proses mengambil data dari tabel operasional.

### Tabel Operasional yang Digunakan

* pelanggans
* kategoris
* produks
* transaksis
* detail_transaksis

### Tujuan Extract

Mengambil data sumber yang akan digunakan untuk membentuk tabel dimensi dan tabel fakta pada data warehouse.

---

## 8.2 Transform

Tahap Transform adalah proses mengubah data operasional menjadi bentuk data warehouse dengan model Star Schema.

### Transformasi Data

* Data pelanggan diubah menjadi dim_pelanggans.
* Data kategori diubah menjadi dim_kategoris.
* Data produk diubah menjadi dim_produks.
* Data tanggal transaksi diubah menjadi dim_waktus.
* Data transaksi dan detail transaksi diubah menjadi fact_penjualans.

### Tujuan Transform

Menyusun data agar sesuai dengan kebutuhan analisis penjualan, seperti analisis berdasarkan produk, kategori, pelanggan, dan waktu.

---

## 8.3 Load

Tahap Load adalah proses menyimpan data hasil transformasi ke dalam tabel data warehouse.

### Tabel Data Warehouse

* dim_pelanggans
* dim_kategoris
* dim_produks
* dim_waktus
* fact_penjualans

### Tujuan Load

Memuat data hasil transformasi ke data warehouse agar dapat digunakan untuk dashboard dan laporan analisis.

---

## 8.4 Mekanisme Proses ETL

Proses ETL dijalankan oleh admin melalui halaman Proses ETL.

### Fitur Halaman Proses ETL

* Menampilkan total transaksi operasional.
* Menampilkan total transaksi selesai.
* Menampilkan jumlah data fact penjualan.
* Menyediakan tombol Jalankan ETL.

### Aturan ETL

* Proses ETL mengambil data dari database operasional.
* Data warehouse akan diperbarui sesuai data operasional terbaru.
* Jika data operasional berubah, admin perlu menjalankan ulang proses ETL.
* Laporan dan dashboard berbasis data warehouse akan mengikuti hasil ETL terbaru.

---

## 9. Data Warehouse

Data warehouse digunakan untuk menyimpan data hasil ETL agar siap dianalisis.

Model yang digunakan adalah Star Schema.

---

## 9.1 Tabel Dimensi

### 9.1.1 dim_pelanggans

Tabel dim_pelanggans menyimpan informasi pelanggan.

Kolom utama:

* id
* pelanggan_id
* nama_pelanggan
* email
* no_hp
* alamat
* jenis_kelamin

---

### 9.1.2 dim_kategoris

Tabel dim_kategoris menyimpan informasi kategori produk sepatu.

Kolom utama:

* id
* kategori_id
* kode_kategori
* nama_kategori
* deskripsi

---

### 9.1.3 dim_produks

Tabel dim_produks menyimpan informasi produk sepatu.

Kolom utama:

* id
* produk_id
* kategori_id
* nama_produk
* nama_kategori
* merek
* ukuran
* warna
* harga_beli
* harga_jual

---

### 9.1.4 dim_waktus

Tabel dim_waktus menyimpan informasi waktu transaksi.

Kolom utama:

* id
* tanggal
* hari
* bulan
* nama_bulan
* tahun
* kuartal

---

## 9.2 Tabel Fakta

### 9.2.1 fact_penjualans

Tabel fact_penjualans adalah tabel utama yang digunakan sebagai pusat analisis penjualan.

Kolom utama:

* id
* transaksi_id
* detail_transaksi_id
* dim_pelanggan_id
* dim_produk_id
* dim_kategori_id
* dim_waktu_id
* kode_transaksi
* jumlah
* harga_satuan
* subtotal
* total_harga
* status

### Fungsi fact_penjualans

Tabel ini digunakan untuk menghitung:

* Total pendapatan.
* Total transaksi.
* Total produk terjual.
* Produk terlaris.
* Kategori terlaris.
* Pendapatan bulanan.
* Ringkasan penjualan.

---

## 10. Star Schema

Model Star Schema digunakan untuk menyusun data warehouse agar mudah dianalisis.

### Struktur Star Schema

```text
                 dim_pelanggans
                       |
dim_produks ---- fact_penjualans ---- dim_kategoris
                       |
                  dim_waktus
```

### Penjelasan

* fact_penjualans menjadi pusat analisis.
* dim_pelanggans digunakan untuk analisis berdasarkan pelanggan.
* dim_produks digunakan untuk analisis berdasarkan produk.
* dim_kategoris digunakan untuk analisis berdasarkan kategori.
* dim_waktus digunakan untuk analisis berdasarkan waktu.

---

## 11. Laporan Analisis

Laporan digunakan untuk menampilkan hasil analisis dari data warehouse.

### Informasi Laporan

* Total pendapatan.
* Total transaksi.
* Total produk terjual.
* Rata-rata transaksi.
* Grafik pendapatan bulanan.
* Grafik kategori terlaris.
* Grafik produk terlaris.
* Tabel produk terlaris.
* Tabel ringkasan penjualan.

### Filter Laporan

Laporan dapat difilter berdasarkan:

* Bulan.
* Tahun.

### Tujuan Laporan

Laporan membantu admin dalam melihat performa toko sepatu berdasarkan data hasil ETL.

---

## 12. Search dan Filter

Sistem menyediakan fitur search dan filter untuk memudahkan admin menemukan data.

### Search Tersedia Pada

* Data Pelanggan.
* Data Kategori.
* Data Produk.
* Data Transaksi.

### Filter Tersedia Pada

* Halaman Laporan.

### Tujuan Search dan Filter

* Mempercepat pencarian data.
* Memudahkan analisis laporan.
* Mengurangi pencarian manual pada tabel data.

---

## 13. Kebutuhan Fungsional

### 13.1 Authentication

* Sistem harus menyediakan fitur login admin.
* Sistem harus menyediakan fitur register admin.
* Sistem harus menyediakan fitur logout admin.
* Sistem harus membatasi akses dashboard hanya untuk admin yang sudah login.

### 13.2 Manajemen Data Operasional

* Sistem harus dapat mengelola data pelanggan.
* Sistem harus dapat mengelola data kategori.
* Sistem harus dapat mengelola data produk.
* Sistem harus dapat mengelola data transaksi.
* Sistem harus menyediakan fitur tambah, edit, hapus, detail, dan pencarian data.

### 13.3 Proses ETL

* Sistem harus dapat menjalankan proses ETL.
* Sistem harus dapat mengambil data dari database operasional.
* Sistem harus dapat mengubah data operasional menjadi format data warehouse.
* Sistem harus dapat menyimpan data ke tabel dimensi dan fakta.

### 13.4 Data Warehouse

* Sistem harus memiliki tabel dimensi.
* Sistem harus memiliki tabel fakta.
* Sistem harus menerapkan Star Schema.
* Sistem harus menampilkan ringkasan data warehouse.

### 13.5 Laporan

* Sistem harus menampilkan laporan dalam bentuk grafik dan tabel.
* Sistem harus menampilkan total pendapatan.
* Sistem harus menampilkan produk terlaris.
* Sistem harus menampilkan kategori terlaris.
* Sistem harus menampilkan grafik pendapatan bulanan.
* Sistem harus menyediakan filter bulan dan tahun.

---

## 14. Kebutuhan Non-Fungsional

### 14.1 Keamanan

* Halaman dashboard hanya dapat diakses oleh admin yang sudah login.
* Sistem menggunakan Laravel Breeze untuk autentikasi.
* Form menggunakan validasi untuk mencegah input tidak valid.

### 14.2 Kemudahan Penggunaan

* Tampilan dibuat responsif untuk laptop, tablet, dan mobile.
* Sidebar admin dapat disembunyikan.
* Landing page memiliki navigasi yang mudah digunakan.
* Data dapat dicari menggunakan fitur search.

### 14.3 Performa

* Data laporan diambil dari data warehouse agar analisis lebih terstruktur.
* Proses ETL dapat dijalankan ulang untuk memperbarui data warehouse.
* Dashboard menggunakan data ringkasan agar mudah dibaca admin.

### 14.4 Tampilan

* Sistem menggunakan tampilan modern.
* Landing page menggunakan animasi AOS.
* Grafik menggunakan Chart.js.
* Tampilan responsif pada mobile, tablet, dan laptop.

---

## 15. Teknologi yang Digunakan

| Teknologi      | Fungsi                                  |
| -------------- | --------------------------------------- |
| Laravel        | Framework utama aplikasi web            |
| PHP            | Bahasa pemrograman backend              |
| MySQL          | Database operasional dan data warehouse |
| Blade          | Template engine Laravel                 |
| Laravel Breeze | Authentication admin                    |
| Vite           | Asset bundling                          |
| CSS            | Styling tampilan                        |
| Tailwind CSS   | Utility styling                         |
| Chart.js       | Visualisasi grafik                      |
| AOS Animation  | Animasi landing page                    |

---

## 16. Alur Sistem

1. Admin membuka website.
2. Admin login ke dashboard.
3. Admin mengelola data pelanggan, kategori, produk, dan transaksi.
4. Data tersimpan di database operasional.
5. Admin membuka halaman Proses ETL.
6. Admin menjalankan proses ETL.
7. Sistem mengambil data dari database operasional.
8. Sistem mengubah data ke bentuk Star Schema.
9. Sistem menyimpan data ke data warehouse.
10. Admin melihat hasil data warehouse.
11. Admin melihat dashboard dan laporan analisis.
12. Admin dapat memfilter laporan berdasarkan bulan dan tahun.

---

## 17. Alur Data

```text
Database Operasional
(pelanggans, kategoris, produks, transaksis, detail_transaksis)
        |
        v
Proses ETL
(Extract, Transform, Load)
        |
        v
Data Warehouse
(dim_pelanggans, dim_kategoris, dim_produks, dim_waktus, fact_penjualans)
        |
        v
Dashboard dan Laporan Analisis
```

---

## 18. Output Sistem

Output utama dari sistem:

* Landing page sistem.
* Halaman login admin.
* Dashboard admin.
* Data pelanggan.
* Data kategori.
* Data produk.
* Data transaksi.
* Halaman proses ETL.
* Halaman data warehouse.
* Halaman laporan analisis.
* Grafik pendapatan bulanan.
* Grafik kategori terlaris.
* Grafik produk terlaris.
* Tabel produk terlaris.
* Tabel ringkasan penjualan.

---

## 19. Batasan Sistem

Sistem ini memiliki beberapa batasan:

* Sistem hanya digunakan oleh admin.
* Sistem belum menyediakan role selain admin.
* Sistem belum menyediakan export PDF atau Excel.
* Sistem belum menyediakan integrasi pembayaran online.
* Sistem belum menyediakan fitur kasir secara real-time.
* Laporan diperbarui setelah proses ETL dijalankan.

---

## 20. Risiko dan Penanganan

| Risiko                                            | Penanganan                                         |
| ------------------------------------------------- | -------------------------------------------------- |
| Data laporan tidak berubah setelah transaksi baru | Admin harus menjalankan proses ETL ulang           |
| Stok produk habis                                 | Sistem menolak transaksi jika stok tidak mencukupi |
| Data warehouse tidak sinkron                      | ETL dijalankan ulang untuk memperbarui data        |
| Admin lupa login                                  | Sistem mengarahkan ke halaman login                |
| Data terlalu banyak                               | Sistem menyediakan search dan filter               |

---

## 21. Kriteria Keberhasilan

Project dianggap berhasil jika:

1. Admin dapat login dan mengakses dashboard.
2. Admin dapat mengelola data pelanggan, kategori, produk, dan transaksi.
3. Sistem dapat menjalankan proses ETL.
4. Data warehouse berhasil terbentuk dari data operasional.
5. Star Schema dapat diterapkan dalam sistem.
6. Dashboard menampilkan ringkasan data secara dinamis.
7. Laporan menampilkan grafik dan tabel dari data warehouse.
8. Filter laporan berdasarkan bulan dan tahun berjalan.
9. Landing page menampilkan informasi sistem secara profesional.
10. Sistem responsif pada laptop, tablet, dan mobile.

---

## 22. Kesimpulan

Sistem Data Warehouse Toko Sepatu dibangun sebagai aplikasi web untuk membantu pengelolaan data operasional dan analisis penjualan toko sepatu. Sistem ini menerapkan proses ETL untuk memindahkan data operasional ke data warehouse, serta menggunakan model Star Schema untuk mendukung analisis data.

Dengan adanya dashboard, laporan grafik, tabel analisis, search, filter, dan visualisasi data, sistem ini dapat membantu admin dalam memantau performa toko sepatu dan mendukung pengambilan keputusan berbasis data.
