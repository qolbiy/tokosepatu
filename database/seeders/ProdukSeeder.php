<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produks = [
            [
                'nama_produk' => 'Adidas Stan Smith',
                'kategori' => 'Sneakers',
                'merek' => 'Adidas',
                'ukuran' => '37-43',
                'warna' => 'Putih Hijau',
                'stok' => 60,
                'harga_beli' => 850000,
                'harga_jual' => 1200000,
                'deskripsi' => 'Sneakers Adidas klasik dengan desain putih minimalis yang populer untuk gaya kasual.',
            ],
            [
                'nama_produk' => 'Adidas Samba OG',
                'kategori' => 'Sneakers',
                'merek' => 'Adidas',
                'ukuran' => '38-44',
                'warna' => 'Putih Hitam',
                'stok' => 55,
                'harga_beli' => 1100000,
                'harga_jual' => 1600000,
                'deskripsi' => 'Sneakers low profile Adidas yang populer untuk gaya casual dan streetwear.',
            ],
            [
                'nama_produk' => 'Adidas Gazelle',
                'kategori' => 'Sneakers',
                'merek' => 'Adidas',
                'ukuran' => '38-44',
                'warna' => 'Biru Putih',
                'stok' => 45,
                'harga_beli' => 950000,
                'harga_jual' => 1400000,
                'deskripsi' => 'Sneakers Adidas dengan desain suede klasik yang banyak digunakan untuk gaya harian.',
            ],
            [
                'nama_produk' => 'Nike Air Force 1',
                'kategori' => 'Sneakers',
                'merek' => 'Nike',
                'ukuran' => '38-44',
                'warna' => 'Putih',
                'stok' => 50,
                'harga_beli' => 1200000,
                'harga_jual' => 1650000,
                'deskripsi' => 'Sneakers Nike ikonik dengan desain putih minimalis yang cocok untuk berbagai gaya.',
            ],
            [
                'nama_produk' => 'Nike Dunk Low',
                'kategori' => 'Sneakers',
                'merek' => 'Nike',
                'ukuran' => '38-44',
                'warna' => 'Putih Hitam',
                'stok' => 42,
                'harga_beli' => 1350000,
                'harga_jual' => 1850000,
                'deskripsi' => 'Sneakers Nike dengan desain low cut yang populer untuk tampilan streetwear.',
            ],
            [
                'nama_produk' => 'Nike Air Jordan 1 Low',
                'kategori' => 'Sneakers',
                'merek' => 'Nike',
                'ukuran' => '39-44',
                'warna' => 'Putih Merah',
                'stok' => 36,
                'harga_beli' => 1600000,
                'harga_jual' => 2300000,
                'deskripsi' => 'Sneakers Jordan low cut dengan desain retro yang banyak diminati pengguna muda.',
            ],
            [
                'nama_produk' => 'New Balance 530',
                'kategori' => 'Sneakers',
                'merek' => 'New Balance',
                'ukuran' => '37-44',
                'warna' => 'Silver Navy',
                'stok' => 48,
                'harga_beli' => 900000,
                'harga_jual' => 1350000,
                'deskripsi' => 'Sneakers New Balance bergaya retro runner yang nyaman untuk aktivitas harian.',
            ],
            [
                'nama_produk' => 'New Balance 9060',
                'kategori' => 'Sneakers',
                'merek' => 'New Balance',
                'ukuran' => '38-44',
                'warna' => 'Grey',
                'stok' => 35,
                'harga_beli' => 1450000,
                'harga_jual' => 2100000,
                'deskripsi' => 'Sneakers New Balance dengan desain chunky modern dan bantalan nyaman.',
            ],
            [
                'nama_produk' => 'ASICS Gel-Kayano 14',
                'kategori' => 'Running Shoes',
                'merek' => 'ASICS',
                'ukuran' => '39-45',
                'warna' => 'Silver Blue',
                'stok' => 32,
                'harga_beli' => 1500000,
                'harga_jual' => 2100000,
                'deskripsi' => 'Sepatu running ASICS dengan desain retro dan teknologi bantalan yang stabil.',
            ],
            [
                'nama_produk' => 'Salomon XT-6',
                'kategori' => 'Running Shoes',
                'merek' => 'Salomon',
                'ukuran' => '40-45',
                'warna' => 'Black',
                'stok' => 25,
                'harga_beli' => 1700000,
                'harga_jual' => 2400000,
                'deskripsi' => 'Sepatu outdoor running Salomon dengan grip kuat untuk aktivitas trail dan harian.',
            ],
            [
                'nama_produk' => 'Nike Pegasus 40',
                'kategori' => 'Running Shoes',
                'merek' => 'Nike',
                'ukuran' => '39-45',
                'warna' => 'Hitam Putih',
                'stok' => 40,
                'harga_beli' => 1350000,
                'harga_jual' => 1800000,
                'deskripsi' => 'Sepatu running Nike yang nyaman untuk latihan lari rutin dan olahraga harian.',
            ],
            [
                'nama_produk' => 'Adidas Ultraboost Light',
                'kategori' => 'Running Shoes',
                'merek' => 'Adidas',
                'ukuran' => '39-45',
                'warna' => 'Grey',
                'stok' => 30,
                'harga_beli' => 1600000,
                'harga_jual' => 2200000,
                'deskripsi' => 'Sepatu running Adidas dengan bantalan responsif untuk aktivitas lari dan training.',
            ],
            [
                'nama_produk' => 'Vans Old Skool',
                'kategori' => 'Sneakers',
                'merek' => 'Vans',
                'ukuran' => '38-44',
                'warna' => 'Hitam Putih',
                'stok' => 46,
                'harga_beli' => 650000,
                'harga_jual' => 950000,
                'deskripsi' => 'Sneakers Vans klasik dengan desain side stripe yang populer untuk gaya streetwear.',
            ],
            [
                'nama_produk' => 'Converse Chuck Taylor All Star',
                'kategori' => 'Sneakers',
                'merek' => 'Converse',
                'ukuran' => '37-44',
                'warna' => 'Black',
                'stok' => 52,
                'harga_beli' => 550000,
                'harga_jual' => 800000,
                'deskripsi' => 'Sepatu canvas Converse klasik yang cocok untuk gaya santai dan penggunaan harian.',
            ],
            [
                'nama_produk' => 'Puma Speedcat',
                'kategori' => 'Casual Shoes',
                'merek' => 'Puma',
                'ukuran' => '38-44',
                'warna' => 'Red White',
                'stok' => 28,
                'harga_beli' => 950000,
                'harga_jual' => 1400000,
                'deskripsi' => 'Sepatu Puma dengan desain low profile yang populer untuk gaya casual modern.',
            ],
            [
                'nama_produk' => 'Skechers Go Walk',
                'kategori' => 'Casual Shoes',
                'merek' => 'Skechers',
                'ukuran' => '38-44',
                'warna' => 'Abu-abu',
                'stok' => 44,
                'harga_beli' => 650000,
                'harga_jual' => 900000,
                'deskripsi' => 'Sepatu casual Skechers yang ringan dan nyaman untuk aktivitas harian.',
            ],
            [
                'nama_produk' => 'Crocs Classic Clog',
                'kategori' => 'Sandals',
                'merek' => 'Crocs',
                'ukuran' => '38-43',
                'warna' => 'White',
                'stok' => 58,
                'harga_beli' => 420000,
                'harga_jual' => 650000,
                'deskripsi' => 'Sandal Crocs ringan dan praktis untuk aktivitas santai sehari-hari.',
            ],
            [
                'nama_produk' => 'Dr. Martens 1461',
                'kategori' => 'Formal Shoes',
                'merek' => 'Dr. Martens',
                'ukuran' => '39-44',
                'warna' => 'Black',
                'stok' => 22,
                'harga_beli' => 1300000,
                'harga_jual' => 1750000,
                'deskripsi' => 'Sepatu formal Dr. Martens dengan desain klasik dan tampilan elegan.',
            ],
            [
                'nama_produk' => 'Clarks Tilden Cap Oxford',
                'kategori' => 'Formal Shoes',
                'merek' => 'Clarks',
                'ukuran' => '40-45',
                'warna' => 'Brown',
                'stok' => 20,
                'harga_beli' => 900000,
                'harga_jual' => 1250000,
                'deskripsi' => 'Sepatu formal Clarks model oxford yang cocok untuk kerja dan acara resmi.',
            ],
            [
                'nama_produk' => 'Hush Puppies Gil Slip On',
                'kategori' => 'Formal Shoes',
                'merek' => 'Hush Puppies',
                'ukuran' => '40-45',
                'warna' => 'Black',
                'stok' => 24,
                'harga_beli' => 780000,
                'harga_jual' => 1050000,
                'deskripsi' => 'Sepatu formal slip on Hush Puppies yang nyaman untuk kerja dan semi formal.',
            ],
        ];

        foreach ($produks as $produk) {
            $namaKategori = $produk['kategori'] ?? 'Sneakers';

            unset($produk['kategori']);

            $kategoriId = Kategori::where('nama_kategori', $namaKategori)->value('id');

            if (!$kategoriId) {
                $kategoriId = Kategori::where('nama_kategori', 'Sneakers')->value('id');
            }

            $produk['kategori_id'] = $kategoriId;

            Produk::updateOrCreate(
                ['nama_produk' => $produk['nama_produk']],
                $produk
            );
        }
    }
}