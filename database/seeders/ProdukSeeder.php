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
                'gambar' => '',
                'harga' => 7000000,
                'stok' => 1000,
                'id_jenis' => 1,
            ],
            [
                'nama_produk' => 'Bibit jagung',
                'gambar' => '',
                'harga' => 150000,
                'stok' => 2000,
                'id_jenis' => 3,
            ],
            [
                'nama_produk' => 'Pestisida',
                'gambar' => '',
                'harga' => 50000,
                'stok' => 5000,
                'id_jenis' => 2,
            ],
            [
                'nama_produk' => 'Pupuk kompos',
                'gambar' => '',
                'harga' => 900000,
                'stok' => 5000,
                'id_jenis' => 1,
            ],
        ]);
    }
}
