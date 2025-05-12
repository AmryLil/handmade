<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use Illuminate\Database\Seeder;

class Kategori extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_2222336'      => 'Aksesori & Perhiasan',
                'deskripsi_2222336' => 'Kalung, gelang, cincin, dan kerajinan tangan perhiasan lainnya.',
                'path_img_2222336'  => 'kategori/aksesori.jpg',
            ],
            [
                'nama_2222336'      => 'Dekorasi Rumah',
                'deskripsi_2222336' => 'Produk dekorasi seperti macrame, lilin aromaterapi, dan hiasan dinding.',
                'path_img_2222336'  => 'kategori/dekorasi.jpg',
            ],
            [
                'nama_2222336'      => 'Pakaian & Tekstil',
                'deskripsi_2222336' => 'Baju rajut, tas handmade, syal, dan tekstil buatan tangan.',
                'path_img_2222336'  => 'kategori/pakaian.jpg',
            ],
            [
                'nama_2222336'      => 'Kerajinan Kayu',
                'deskripsi_2222336' => 'Rak mini, ukiran kayu, mainan kayu, dan peralatan dapur handmade.',
                'path_img_2222336'  => 'kategori/kayu.jpg',
            ],
            [
                'nama_2222336'      => 'Keramik & Tanah Liat',
                'deskripsi_2222336' => 'Mug, vas, patung mini dari tanah liat yang dibuat manual.',
                'path_img_2222336'  => 'kategori/keramik.jpg',
            ],
        ];

        foreach ($data as $item) {
            KategoriProduk::create($item);  // ID akan dibuat otomatis di model
        }
    }
}
