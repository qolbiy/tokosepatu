<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class UpdateFotoProdukSeeder extends Seeder
{
    public function run(): void
    {
        $fotoProduks = [
            'Adidas Stan Smith' => 'adidas-stan-smith.jpg',
            'Adidas Samba OG' => 'adidas-samba-og.jpg',
            'Adidas Gazelle' => 'adidas-gazelle.jpg',
            'Nike Air Force 1' => 'nike-air-force-1.jpg',
            'Nike Dunk Low' => 'nike-dunk-low.jpg',
            'Nike Air Jordan 1 Low' => 'nike-air-jordan-1-low.jpg',
            'New Balance 530' => 'new-balance-530.jpg',
            'New Balance 9060' => 'new-balance-9060.jpg',
            'ASICS Gel-Kayano 14' => 'asics-gel-kayano-14.jpg',
            'Salomon XT-6' => 'salomon-xt-6.jpg',
            'Nike Pegasus 40' => 'nike-pegasus-40.jpg',
            'Adidas Ultraboost Light' => 'adidas-ultraboost-light.jpg',
            'Vans Old Skool' => 'vans-old-skool.jpg',
            'Converse Chuck Taylor All Star' => 'converse-chuck-taylor-all-star.jpg',
            'Puma Speedcat' => 'puma-speedcat.jpg',
            'Skechers Go Walk' => 'skechers-go-walk.jpg',
            'Crocs Classic Clog' => 'crocs-classic-clog.jpg',
            'Dr. Martens 1461' => 'dr-martens-1461.jpg',
            'Clarks Tilden Cap Oxford' => 'clarks-tilden-cap-oxford.jpg',
            'Hush Puppies Gil Slip On' => 'hush-puppies-gil-slip-on.jpg',
        ];

        foreach ($fotoProduks as $namaProduk => $namaFoto) {
            Produk::where('nama_produk', $namaProduk)->update([
                'foto' => $namaFoto,
            ]);
        }
    }
}