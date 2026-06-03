# Product Requirements Document (PRD)

## ShoeDW - Sistem Data Warehouse Toko Sepatu Berbasis Web

---

## 1. Informasi Dokumen

| Keterangan    | Detail                                               |
| ------------- | ---------------------------------------------------- |
| Nama Project  | ShoeDW - Sistem Data Warehouse Toko Sepatu           |
| Jenis Project | Aplikasi Web Toko Sepatu dan Data Warehouse          |
| Framework     | Laravel                                              |
| Database      | MySQL                                                |
| Mata Kuliah   | Data Warehouse                                       |
| Semester      | 8                                                    |
| Pengembang    | Nayuda Gigih Fayruz Qolbiy, Mukhlis Annas Faturahman |
| Versi Dokumen | 2.0                                                  |

---

## 2. Ringkasan Project

ShoeDW adalah aplikasi berbasis web yang digunakan untuk mengelola toko sepatu, mulai dari tampilan landing page untuk pembeli, katalog produk, checkout pembelian, pengelolaan transaksi, proses ETL, data warehouse, hingga laporan analisis penjualan. Sistem ini dibangun menggunakan framework Laravel dan database MySQL.

Sistem memiliki dua sisi utama, yaitu sisi user dan sisi admin. Pada sisi user, pembeli dapat melihat produk sepatu, memfilter produk berdasarkan kategori atau merek, melihat produk terlaris, membaca testimoni pelanggan, dan melakukan checkout melalui tombol Beli Sekarang. Pada sisi admin, pengguna dapat mengelola data pelanggan, kategori, produk, transaksi, proses ETL, data warehouse, dashboard, dan laporan analisis.

Data transaksi yang sudah selesai diproses melalui ETL untuk dimasukkan ke dalam data warehouse. Data warehouse menggunakan model Star Schema dengan tabel fakta penjualan sebagai pusat analisis dan tabel dimensi sebagai pendukung. Data hasil ETL digunakan untuk menampilkan laporan, grafik, dashboard, dan ranking produk terlaris pada landing page.

---

## 3. Latar Belakang

Dalam kegiatan toko sepatu, data produk, pelanggan, kategori, dan transaksi terus bertambah dari waktu ke waktu. Jika data hanya disimpan dalam bentuk operasional, proses analisis seperti mengetahui produk terlaris, kategori terlaris, pendapatan bulanan, dan performa penjualan akan menjadi kurang efektif.

Selain kebutuhan admin, sistem juga perlu menyediakan halaman user yang dapat digunakan pembeli untuk melihat produk dan melakukan pembelian secara langsung. Oleh karena itu, ShoeDW tidak hanya berfungsi sebagai sistem data warehouse, tetapi juga sebagai aplikasi toko sepatu berbasis web dengan fitur checkout sederhana.

Agar data transaksi dapat dianalisis dengan lebih terstruktur, sistem menerapkan proses ETL dari database operasional ke data warehouse. Model Star Schema digunakan agar data penjualan dapat dianalisis berdasarkan pelanggan, produk, kategori, dan waktu. Dengan demikian, sistem dapat membantu admin memantau performa toko berdasarkan data transaksi yang valid.

---

## 4. Tujuan Project

Tujuan dari sistem ini adalah:

1. Membangun aplikasi toko sepatu berbasis web menggunakan Laravel.
2. Menyediakan landing page user untuk menampilkan produk, ranking, testimoni, dan fitur pembelian.
3. Menyediakan fitur checkout pembelian langsung dari landing page.
4. Mengelola data operasional toko sepatu seperti pelanggan, kategori, produk, dan transaksi.
5. Menerapkan metode pembayaran COD, Transfer Bank, dan QRIS Simulasi.
6. Menerapkan status transaksi Pending dan Selesai berdasarkan metode pembayaran.
7. Menyediakan fitur konfirmasi transaksi Pending oleh admin.
8. Menerapkan proses ETL dari database operasional ke data warehouse.
9. Menerapkan model Star Schema pada sistem data warehouse toko sepatu.
10. Menampilkan dashboard dan laporan analisis dalam bentuk grafik dan tabel.
11. Menampilkan ranking produk terlaris berdasarkan data transaksi yang sudah selesai.

---

## 5. Pengguna Sistem

### 5.1 User / Pembeli

User adalah pengunjung landing page yang dapat melihat informasi produk dan melakukan pembelian melalui fitur checkout.

User memiliki akses untuk:

* Melihat halaman beranda.
* Melihat daftar produk sepatu.
* Memfilter produk berdasarkan kategori dan merek.
* Melihat detail produk.
* Melakukan checkout melalui tombol Beli Sekarang.
* Mengisi data pembelian.
* Memilih metode pembayaran.
* Melihat ranking produk terlaris.
* Melihat testimoni pelanggan.

---

### 5.2 Admin

Admin adalah pengguna yang memiliki akses ke dashboard dan fitur pengelolaan sistem.

Admin memiliki akses untuk:

* Register dan login ke dashboard.
* Mengelola data pelanggan.
* Mengelola data kategori.
* Mengelola data produk.
* Mengelola data transaksi.
* Mengonfirmasi transaksi Pending.
* Menjalankan proses ETL.
* Melihat data warehouse.
* Melihat dashboard performa toko.
* Melihat laporan analisis penjualan.

---

## 6. Ruang Lingkup Sistem

Sistem mencakup beberapa modul utama:

1. Landing Page User.
2. Katalog Produk.
3. Detail Produk.
4. Checkout Pembelian.
5. Metode Pembayaran.
6. Testimoni Pelanggan.
7. Ranking Produk Terlaris.
8. Authentication Admin.
9. Dashboard Admin.
10. CRUD Data Pelanggan.
11. CRUD Data Kategori.
12. CRUD Data Produk.
13. CRUD Data Transaksi.
14. Konfirmasi Transaksi Pending.
15. Proses ETL.
16. Data Warehouse.
17. Laporan Analisis.
18. Search dan Filter Data.
19. Visualisasi Grafik.
20. Responsive Layout.

---

## 7. Fitur Sistem

---

## 7.1 Landing Page User

Landing page berfungsi sebagai halaman utama yang dilihat oleh user atau pembeli. Tampilan landing page dibuat lebih sesuai dengan kebutuhan pembeli toko sepatu, sehingga informasi yang ditampilkan tidak terlalu teknis dan lebih fokus pada produk serta proses pembelian.

### Menu Landing Page

* Beranda.
* Produk.
* Ranking.
* Testimoni.
* Login Admin.

Bagian teknologi yang digunakan tetap ditampilkan pada landing page sebagai informasi pendukung project, tetapi tidak dimasukkan ke dalam menu utama navbar agar tampilan lebih profesional untuk user.

### Informasi yang Ditampilkan

* Deskripsi singkat ShoeDW.
* Total produk.
* Total kategori.
* Total transaksi.
* Total pendapatan.
* Daftar produk sepatu.
* Filter kategori dan merek.
* Produk terlaris.
* Ranking produk terlaris.
* Testimoni pelanggan.
* Teknologi yang digunakan.
* Footer.

### Tujuan Landing Page

Landing page digunakan untuk membantu user melihat katalog produk, mengetahui produk yang paling diminati, membaca testimoni, dan melakukan pembelian secara langsung melalui fitur checkout.

---

## 7.2 Katalog Produk

Katalog produk digunakan untuk menampilkan produk sepatu yang tersedia pada sistem.

### Fitur Katalog Produk

* Menampilkan gambar produk.
* Menampilkan nama produk.
* Menampilkan kategori produk.
* Menampilkan merek.
* Menampilkan warna.
* Menampilkan harga jual.
* Menampilkan stok.
* Menampilkan badge stok.
* Menampilkan tombol Detail.
* Menampilkan tombol Beli Sekarang.
* Menampilkan tombol Stok Habis jika stok produk kosong.

### Filter Produk

User dapat memfilter produk berdasarkan:

* Kategori.
* Merek.

### Tujuan Katalog Produk

Katalog produk membantu user memilih produk sepatu berdasarkan informasi yang jelas, seperti kategori, merek, harga, warna, dan stok produk.

---

## 7.3 Detail Produk

Detail produk digunakan untuk menampilkan informasi produk secara lebih lengkap sebelum user melakukan pembelian.

### Informasi Detail Produk

* Nama produk.
* Foto produk.
* Kategori.
* Merek.
* Ukuran.
* Warna.
* Harga jual.
* Stok.
* Deskripsi produk jika tersedia.

### Tujuan Detail Produk

Detail produk membantu user memahami informasi sepatu sebelum memutuskan untuk membeli produk tersebut.

---

## 7.4 Checkout Pembelian

Checkout pembelian digunakan oleh user untuk membeli produk secara langsung dari landing page melalui tombol Beli Sekarang.

### Data Checkout

Data yang diisi user pada form checkout:

* Nama pembeli.
* Email.
* Nomor WhatsApp.
* Jenis kelamin.
* Alamat.
* Jumlah pembelian.
* Metode pembayaran.

### Validasi Checkout

Sistem melakukan validasi terhadap:

* Produk yang dipilih harus tersedia.
* Nama pembeli wajib diisi.
* Email wajib diisi dengan format email.
* Nomor WhatsApp wajib diisi.
* Jenis kelamin wajib dipilih.
* Alamat wajib diisi.
* Jumlah pembelian minimal 1.
* Jumlah pembelian tidak boleh melebihi stok.
* Metode pembayaran harus sesuai pilihan yang tersedia.

### Proses Checkout

1. User menekan tombol Beli Sekarang.
2. Sistem menampilkan modal checkout.
3. User mengisi data pembelian.
4. User memilih metode pembayaran.
5. Sistem menampilkan konfirmasi pembelian menggunakan SweetAlert2.
6. Jika user menyetujui, data transaksi disimpan.
7. Stok produk berkurang sesuai jumlah pembelian.
8. Status transaksi ditentukan berdasarkan metode pembayaran.

### Tujuan Checkout

Checkout digunakan agar user dapat melakukan transaksi pembelian secara langsung dari landing page tanpa harus masuk ke dashboard admin.

---

## 7.5 Metode Pembayaran

Sistem menyediakan tiga metode pembayaran.

### Metode Pembayaran yang Tersedia

* COD.
* Transfer Bank.
* QRIS Simulasi.

### Aturan Metode Pembayaran

* COD langsung menghasilkan transaksi dengan status Selesai.
* Transfer Bank menghasilkan transaksi dengan status Pending.
* QRIS Simulasi menghasilkan transaksi dengan status Pending.

### Informasi Pembayaran

Pada modal checkout, sistem menampilkan informasi pembayaran sesuai metode yang dipilih.

Informasi yang ditampilkan:

* Penjelasan COD.
* Informasi rekening untuk Transfer Bank.
* Gambar QRIS simulasi untuk QRIS Simulasi.

### Tujuan Metode Pembayaran

Metode pembayaran digunakan untuk membedakan alur transaksi antara pembayaran langsung dan pembayaran yang membutuhkan konfirmasi admin.

---

## 7.6 Ranking Produk Terlaris

Ranking produk terlaris digunakan untuk menampilkan produk sepatu yang paling banyak terjual.

### Sumber Data Ranking

Ranking produk diambil dari data warehouse, khususnya dari tabel fact_penjualans yang sudah diproses melalui ETL.

### Aturan Ranking

* Ranking hanya menghitung transaksi dengan status Selesai.
* Transaksi Pending tidak masuk ke ranking.
* Ranking diperbarui setelah admin menjalankan proses ETL.
* Produk diurutkan berdasarkan jumlah terjual tertinggi.

### Informasi Ranking

* Nomor ranking.
* Foto produk.
* Nama produk.
* Kategori produk.
* Total terjual.
* Total pendapatan.

### Tujuan Ranking

Ranking membantu user mengetahui produk yang paling diminati dan membantu admin melihat performa produk berdasarkan data penjualan.

---

## 7.7 Testimoni Pelanggan

Testimoni digunakan untuk menampilkan ulasan pelanggan pada landing page.

### Sumber Data Testimoni

Nama pelanggan diambil dari data pelanggan yang tersimpan pada database. Kalimat testimoni ditampilkan secara dinamis berdasarkan daftar review yang telah disiapkan pada landing page.

### Fitur Testimoni

* Menampilkan nama pelanggan.
* Menampilkan alamat pelanggan jika tersedia.
* Menampilkan review pelanggan.
* Menampilkan rating bintang.
* Testimoni berjalan horizontal dari kanan ke kiri.
* Testimoni dapat digerakkan ke kanan atau kiri melalui hover/cursor.
* Animasi testimoni dibuat menyerupai marquee teknologi.

### Tujuan Testimoni

Testimoni digunakan untuk membuat landing page terlihat lebih profesional, meningkatkan kepercayaan user, dan menampilkan pengalaman pelanggan terhadap sistem ShoeDW.

---

## 7.8 Teknologi yang Digunakan

Bagian teknologi digunakan untuk menampilkan teknologi yang digunakan dalam pengembangan sistem.

### Fitur Bagian Teknologi

* Menampilkan daftar teknologi.
* Animasi berjalan horizontal.
* Gerakan dapat mengikuti arah cursor.
* Background dibuat soft agar tidak terlalu mencolok.
* Tidak dimasukkan ke navbar utama.

### Tujuan Bagian Teknologi

Bagian teknologi digunakan sebagai informasi pendukung project, terutama untuk menjelaskan teknologi yang digunakan dalam pengembangan sistem kepada dosen atau penguji.

---

## 7.9 Authentication Admin

Sistem menggunakan Laravel Breeze untuk fitur autentikasi admin.

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

## 7.10 Dashboard Admin

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

## 7.11 Data Pelanggan

Modul Data Pelanggan digunakan untuk mengelola data pelanggan toko sepatu. Data pelanggan dapat berasal dari input admin maupun dari checkout user di landing page.

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
* Jenis kelamin.
* Alamat.

### Search Data Pelanggan

Admin dapat mencari data pelanggan berdasarkan:

* Nama pelanggan.
* Email.
* Nomor HP.
* Jenis kelamin.
* Alamat.

---

## 7.12 Data Kategori

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

## 7.13 Data Produk

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
* Foto produk.

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
* Produk dengan stok kosong akan ditampilkan sebagai stok habis pada landing page.

---

## 7.14 Data Transaksi

Modul Data Transaksi digunakan untuk mencatat dan mengelola transaksi penjualan sepatu.

### Fitur Data Transaksi

* Menampilkan daftar transaksi.
* Menambah transaksi.
* Mengubah transaksi.
* Menghapus transaksi.
* Melihat detail transaksi.
* Search data transaksi.
* Menampilkan metode pembayaran.
* Menampilkan badge status Pending dan Selesai.
* Menampilkan tombol Konfirmasi untuk transaksi Pending.
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
* Metode pembayaran.
* Status transaksi.

### Search Data Transaksi

Admin dapat mencari data transaksi berdasarkan:

* Kode transaksi.
* Nama pelanggan.
* Nama produk.
* Tanggal transaksi.
* Metode pembayaran.
* Status transaksi.

### Validasi Transaksi

* Transaksi tidak dapat disimpan jika stok produk tidak mencukupi.
* Jika checkout berhasil, stok produk akan berkurang.
* Produk dengan stok kosong tidak dapat dibeli dari landing page.
* Status transaksi mengikuti metode pembayaran.
* Transaksi Pending perlu dikonfirmasi admin sebelum masuk ke data warehouse.

---

## 7.15 Konfirmasi Transaksi

Konfirmasi transaksi digunakan untuk mengubah status transaksi dari Pending menjadi Selesai.

### Aturan Konfirmasi

* Tombol Konfirmasi hanya muncul pada transaksi berstatus Pending.
* Transaksi COD tidak memerlukan konfirmasi karena langsung berstatus Selesai.
* Transaksi Transfer Bank dan QRIS Simulasi memerlukan konfirmasi admin.
* Konfirmasi menggunakan SweetAlert2.
* Setelah dikonfirmasi, status transaksi berubah menjadi Selesai.

### Tujuan Konfirmasi

Konfirmasi digunakan agar hanya transaksi yang dianggap valid yang masuk ke data warehouse dan ranking produk.

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
* Hanya transaksi dengan status Selesai yang diubah menjadi data fakta penjualan.

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

Memuat data hasil transformasi ke data warehouse agar dapat digunakan untuk dashboard, laporan analisis, dan ranking produk terlaris.

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
* ETL hanya memproses transaksi dengan status Selesai.
* Transaksi Pending tidak masuk ke fact_penjualans.
* Ranking produk pada landing page mengikuti hasil ETL terakhir.

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
* jenis_kelamin
* alamat

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
* Ranking produk terlaris pada landing page.

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

Sistem menyediakan fitur search dan filter untuk memudahkan user dan admin menemukan data.

### Search Admin Tersedia Pada

* Data Pelanggan.
* Data Kategori.
* Data Produk.
* Data Transaksi.

### Filter User Tersedia Pada

* Filter produk berdasarkan kategori.
* Filter produk berdasarkan merek.

### Filter Admin Tersedia Pada

* Halaman Laporan berdasarkan bulan dan tahun.

### Tujuan Search dan Filter

* Mempercepat pencarian data.
* Memudahkan user menemukan produk.
* Memudahkan admin menemukan data operasional.
* Memudahkan analisis laporan.
* Mengurangi pencarian manual pada tabel data.

---

## 13. Kebutuhan Fungsional

### 13.1 Landing Page User

* Sistem harus menampilkan halaman beranda.
* Sistem harus menampilkan katalog produk.
* Sistem harus menampilkan filter kategori dan merek.
* Sistem harus menampilkan detail produk.
* Sistem harus menampilkan ranking produk terlaris.
* Sistem harus menampilkan testimoni pelanggan.
* Sistem harus menyediakan tombol Login Admin.

### 13.2 Checkout Pembelian

* Sistem harus menyediakan tombol Beli Sekarang.
* Sistem harus menampilkan modal checkout.
* Sistem harus menyimpan data pembeli ke tabel pelanggan.
* Sistem harus menyimpan data transaksi ke tabel transaksi.
* Sistem harus menyimpan detail transaksi ke tabel detail_transaksis.
* Sistem harus mengurangi stok produk setelah checkout berhasil.
* Sistem harus menentukan status transaksi berdasarkan metode pembayaran.
* Sistem harus menampilkan SweetAlert2 sebelum checkout disimpan.
* Sistem harus menolak checkout jika stok tidak mencukupi.

### 13.3 Authentication

* Sistem harus menyediakan fitur login admin.
* Sistem harus menyediakan fitur register admin.
* Sistem harus menyediakan fitur logout admin.
* Sistem harus membatasi akses dashboard hanya untuk admin yang sudah login.

### 13.4 Manajemen Data Operasional

* Sistem harus dapat mengelola data pelanggan.
* Sistem harus dapat mengelola data kategori.
* Sistem harus dapat mengelola data produk.
* Sistem harus dapat mengelola data transaksi.
* Sistem harus menyediakan fitur tambah, edit, hapus, detail, dan pencarian data.

### 13.5 Konfirmasi Transaksi

* Sistem harus menampilkan tombol Konfirmasi pada transaksi Pending.
* Sistem harus mengubah status Pending menjadi Selesai setelah dikonfirmasi.
* Sistem harus menggunakan SweetAlert2 untuk konfirmasi transaksi.
* Sistem harus menyembunyikan tombol Konfirmasi pada transaksi Selesai.

### 13.6 Proses ETL

* Sistem harus dapat menjalankan proses ETL.
* Sistem harus dapat mengambil data dari database operasional.
* Sistem harus dapat mengubah data operasional menjadi format data warehouse.
* Sistem harus dapat menyimpan data ke tabel dimensi dan fakta.
* Sistem harus hanya memproses transaksi dengan status Selesai.
* Sistem tidak boleh memasukkan transaksi Pending ke fact_penjualans.

### 13.7 Data Warehouse

* Sistem harus memiliki tabel dimensi.
* Sistem harus memiliki tabel fakta.
* Sistem harus menerapkan Star Schema.
* Sistem harus menampilkan ringkasan data warehouse.

### 13.8 Laporan

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
* Aksi penting seperti checkout, hapus data, dan konfirmasi transaksi menggunakan alert konfirmasi.
* Request form menggunakan CSRF protection dari Laravel.

### 14.2 Kemudahan Penggunaan

* Tampilan dibuat responsif untuk laptop, tablet, dan mobile.
* Sidebar admin dapat disembunyikan.
* Navbar landing dapat digunakan pada perangkat mobile.
* Landing page memiliki navigasi yang sederhana.
* Data dapat dicari menggunakan fitur search.
* Produk dapat difilter berdasarkan kategori dan merek.
* Checkout dapat dilakukan langsung dari landing page.

### 14.3 Performa

* Data laporan diambil dari data warehouse agar analisis lebih terstruktur.
* Proses ETL dapat dijalankan ulang untuk memperbarui data warehouse.
* Dashboard menggunakan data ringkasan agar mudah dibaca admin.
* Ranking produk mengambil data dari hasil ETL agar lebih valid.
* Produk landing dibatasi agar tampilan tetap ringan.

### 14.4 Tampilan

* Sistem menggunakan tampilan modern dan responsif.
* Landing page menggunakan animasi AOS.
* Grafik menggunakan Chart.js.
* Alert menggunakan SweetAlert2.
* Testimoni menggunakan animasi marquee yang dapat dikontrol cursor.
* Teknologi menggunakan animasi marquee dengan background soft.
* Tampilan responsif pada mobile, tablet, dan laptop.

---

## 15. Teknologi yang Digunakan

| Teknologi      | Fungsi                                               |
| -------------- | ---------------------------------------------------- |
| Laravel        | Framework utama aplikasi web                         |
| PHP            | Bahasa pemrograman backend                           |
| MySQL          | Database operasional dan data warehouse              |
| Blade          | Template engine Laravel                              |
| Laravel Breeze | Authentication admin                                 |
| Vite           | Asset bundling                                       |
| CSS            | Styling tampilan                                     |
| Tailwind CSS   | Utility styling                                      |
| JavaScript     | Interaksi landing page dan dashboard                 |
| Chart.js       | Visualisasi grafik                                   |
| AOS Animation  | Animasi scroll landing page                          |
| SweetAlert2    | Alert checkout, hapus data, dan konfirmasi transaksi |

---

## 16. Alur Sistem

### 16.1 Alur User

1. User membuka landing page.
2. User melihat katalog produk sepatu.
3. User memfilter produk berdasarkan kategori atau merek.
4. User melihat detail produk.
5. User menekan tombol Beli Sekarang.
6. Sistem menampilkan modal checkout.
7. User mengisi data pembelian.
8. User memilih metode pembayaran.
9. Sistem menampilkan konfirmasi checkout menggunakan SweetAlert2.
10. Sistem menyimpan data pelanggan.
11. Sistem menyimpan transaksi.
12. Sistem menyimpan detail transaksi.
13. Sistem mengurangi stok produk.
14. Sistem menentukan status transaksi berdasarkan metode pembayaran.

### 16.2 Alur Admin

1. Admin membuka website.
2. Admin login ke dashboard.
3. Admin mengelola data pelanggan, kategori, produk, dan transaksi.
4. Admin mengecek transaksi yang masuk.
5. Admin mengonfirmasi transaksi Pending jika diperlukan.
6. Admin membuka halaman Proses ETL.
7. Admin menjalankan proses ETL.
8. Sistem mengambil transaksi dengan status Selesai.
9. Sistem mengubah data ke bentuk Star Schema.
10. Sistem menyimpan data ke data warehouse.
11. Admin melihat hasil data warehouse.
12. Admin melihat dashboard dan laporan analisis.
13. Ranking produk pada landing page diperbarui berdasarkan hasil ETL.

---

## 17. Alur Status Transaksi

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

### Penjelasan Alur Status

* Jika user memilih COD, transaksi langsung masuk sebagai Selesai.
* Jika user memilih Transfer Bank, transaksi masuk sebagai Pending.
* Jika user memilih QRIS Simulasi, transaksi masuk sebagai Pending.
* Transaksi Pending harus dikonfirmasi admin agar berubah menjadi Selesai.
* ETL hanya memproses transaksi Selesai.
* Ranking produk hanya menghitung transaksi yang sudah masuk ke fact_penjualans.

---

## 18. Alur Data

```text
Landing Page / Admin
        |
        v
Database Operasional
(pelanggans, kategoris, produks, transaksis, detail_transaksis)
        |
        v
Transaksi Status Selesai
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
Dashboard, Laporan, dan Ranking Produk
```

---

## 19. Output Sistem

Output utama dari sistem:

* Landing page user.
* Katalog produk.
* Detail produk.
* Modal checkout.
* Ranking produk terlaris.
* Testimoni pelanggan.
* Halaman login admin.
* Halaman register admin.
* Dashboard admin.
* Data pelanggan.
* Data kategori.
* Data produk.
* Data transaksi.
* Detail transaksi.
* Badge status transaksi.
* Konfirmasi transaksi Pending.
* Halaman proses ETL.
* Halaman data warehouse.
* Halaman laporan analisis.
* Grafik pendapatan bulanan.
* Grafik kategori terlaris.
* Grafik produk terlaris.
* Tabel produk terlaris.
* Tabel ringkasan penjualan.

---

## 20. Batasan Sistem

Sistem ini memiliki beberapa batasan:

* Sistem hanya menyediakan role admin untuk dashboard.
* Sistem belum menyediakan role khusus pelanggan.
* Checkout pelanggan dilakukan tanpa akun user.
* Sistem belum menyediakan payment gateway asli.
* Transfer Bank dan QRIS masih bersifat simulasi.
* Sistem belum menyediakan export PDF atau Excel.
* Sistem belum menyediakan fitur kasir real-time.
* Laporan diperbarui setelah proses ETL dijalankan.
* Ranking landing diperbarui setelah proses ETL dijalankan.
* Testimoni belum menggunakan tabel khusus review pelanggan.
* Teknologi yang digunakan ditampilkan sebagai informasi pendukung project.

---

## 21. Risiko dan Penanganan

| Risiko                                                | Penanganan                                                             |
| ----------------------------------------------------- | ---------------------------------------------------------------------- |
| Data laporan tidak berubah setelah transaksi baru     | Admin harus menjalankan proses ETL ulang                               |
| Ranking landing tidak berubah setelah transaksi       | Admin harus menjalankan proses ETL setelah transaksi berstatus selesai |
| Transaksi Transfer Bank atau QRIS belum masuk laporan | Admin harus mengonfirmasi transaksi Pending menjadi Selesai            |
| Stok produk habis                                     | Sistem menonaktifkan tombol pembelian dan menampilkan status habis     |
| Stok tidak mencukupi saat checkout                    | Sistem menolak transaksi                                               |
| Data warehouse tidak sinkron                          | ETL dijalankan ulang untuk memperbarui data                            |
| Admin belum login                                     | Sistem mengarahkan ke halaman login                                    |
| Data terlalu banyak                                   | Sistem menyediakan search dan filter                                   |
| User lupa mengisi data checkout                       | Sistem menampilkan validasi dan SweetAlert2                            |
| Pembayaran online belum nyata                         | Sistem menggunakan Transfer Bank dan QRIS Simulasi                     |

---

## 22. Kriteria Keberhasilan

Project dianggap berhasil jika:

1. User dapat membuka landing page dengan tampilan responsif.
2. User dapat melihat katalog produk.
3. User dapat memfilter produk berdasarkan kategori dan merek.
4. User dapat melihat detail produk.
5. User dapat melakukan checkout dari landing page.
6. Sistem dapat menyimpan data pelanggan dari checkout.
7. Sistem dapat menyimpan transaksi dan detail transaksi.
8. Sistem dapat mengurangi stok produk setelah checkout berhasil.
9. Sistem dapat membedakan status transaksi berdasarkan metode pembayaran.
10. COD otomatis menghasilkan transaksi Selesai.
11. Transfer Bank dan QRIS Simulasi menghasilkan transaksi Pending.
12. Admin dapat login dan mengakses dashboard.
13. Admin dapat mengelola data pelanggan, kategori, produk, dan transaksi.
14. Admin dapat mengonfirmasi transaksi Pending menjadi Selesai.
15. Sistem dapat menjalankan proses ETL.
16. ETL hanya memproses transaksi Selesai.
17. Data warehouse berhasil terbentuk dari data operasional.
18. Star Schema dapat diterapkan dalam sistem.
19. Dashboard menampilkan ringkasan data secara dinamis.
20. Laporan menampilkan grafik dan tabel dari data warehouse.
21. Filter laporan berdasarkan bulan dan tahun berjalan.
22. Ranking produk pada landing page mengambil data dari hasil ETL.
23. Testimoni pelanggan tampil dan bergerak pada landing page.
24. Sistem responsif pada laptop, tablet, dan mobile.

---

## 23. Kesimpulan

ShoeDW - Sistem Data Warehouse Toko Sepatu Berbasis Web dibangun sebagai aplikasi yang menggabungkan fitur toko sepatu online sederhana dan sistem data warehouse. Pada sisi user, sistem menyediakan landing page, katalog produk, filter produk, detail produk, checkout pembelian, ranking produk terlaris, dan testimoni pelanggan. Pada sisi admin, sistem menyediakan dashboard, CRUD data operasional, konfirmasi transaksi, proses ETL, data warehouse, dan laporan analisis.

Sistem ini menerapkan alur status transaksi berdasarkan metode pembayaran. Transaksi COD langsung masuk sebagai Selesai, sedangkan transaksi Transfer Bank dan QRIS Simulasi masuk sebagai Pending sampai dikonfirmasi oleh admin. Proses ETL hanya memproses transaksi dengan status Selesai, sehingga data warehouse, laporan, dan ranking produk lebih valid.

Dengan adanya proses ETL, model Star Schema, dashboard, laporan grafik, tabel analisis, search, filter, checkout, dan ranking produk, sistem ini dapat membantu pengelolaan toko sepatu sekaligus mendukung pemantauan performa penjualan berdasarkan data yang telah diproses.
