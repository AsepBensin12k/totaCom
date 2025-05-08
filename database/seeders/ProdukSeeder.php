<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        DB::table('produks')->insert([
            [
                'nama_produk' => 'Pupuk Sapi',
                'gambar' => '', // Gambar disesuaikan jika ada file
                'harga' => 7000000,
                'stok' => 1000,
                'id_jenis' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Bibit Jagung',
                'gambar' => '',
                'harga' => 150000,
                'stok' => 2000,
                'id_jenis' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Pestisida',
                'gambar' => '',
                'harga' => 50000,
                'stok' => 5000,
                'id_jenis' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Pupuk Kompos',
                'gambar' => '',
                'harga' => 900000,
                'stok' => 5000,
                'id_jenis' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Alat Penyemprot',
                'gambar' => '',
                'harga' => 300000,
                'stok' => 1500,
                'id_jenis' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Benih Padi',
                'gambar' => '',
                'harga' => 200000,
                'stok' => 3000,
                'id_jenis' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Pupuk NPK',
                'gambar' => '',
                'harga' => 500000,
                'stok' => 4000,
                'id_jenis' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Pestisida Organik',
                'gambar' => '',
                'harga' => 75000,
                'stok' => 3000,
                'id_jenis' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Pupuk Urea',
                'gambar' => '',
                'harga' => 400000,
                'stok' => 2000,
                'id_jenis' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Benih Cabai',
                'gambar' => '',
                'harga' => 175000,
                'stok' => 2500,
                'id_jenis' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
