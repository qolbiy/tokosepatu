<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'kode_kategori' => 'SNK',
                'nama_kategori' => 'Sneakers',
                'deskripsi' => 'Kategori sepatu casual modern untuk aktivitas harian dan gaya streetwear.',
            ],
            [
                'kode_kategori' => 'RUN',
                'nama_kategori' => 'Running Shoes',
                'deskripsi' => 'Kategori sepatu untuk olahraga lari, jogging, dan aktivitas fitness ringan.',
            ],
            [
                'kode_kategori' => 'FRM',
                'nama_kategori' => 'Formal Shoes',
                'deskripsi' => 'Kategori sepatu formal untuk kerja, acara resmi, dan kebutuhan profesional.',
            ],
            [
                'kode_kategori' => 'SPT',
                'nama_kategori' => 'Sport Shoes',
                'deskripsi' => 'Kategori sepatu olahraga untuk training, gym, dan aktivitas fisik.',
            ],
            [
                'kode_kategori' => 'CSL',
                'nama_kategori' => 'Casual Shoes',
                'deskripsi' => 'Kategori sepatu santai untuk penggunaan sehari-hari.',
            ],
            [
                'kode_kategori' => 'BOT',
                'nama_kategori' => 'Boots',
                'deskripsi' => 'Kategori sepatu boots untuk gaya casual, outdoor, dan perlindungan kaki.',
            ],
            [
                'kode_kategori' => 'SLP',
                'nama_kategori' => 'Slip On',
                'deskripsi' => 'Kategori sepatu praktis tanpa tali untuk aktivitas harian.',
            ],
            [
                'kode_kategori' => 'LOF',
                'nama_kategori' => 'Loafers',
                'deskripsi' => 'Kategori sepatu semi-formal yang cocok untuk kerja dan acara santai.',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(
                ['kode_kategori' => $kategori['kode_kategori']],
                $kategori
            );
        }
    }
}