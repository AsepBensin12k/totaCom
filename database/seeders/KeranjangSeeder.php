<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeranjangSeeder extends Seeder
{
    public function run()
    {
        DB::table('keranjangs')->insert([
            [
                'id_akun' => 2,
                'id_produk' => 1,
                'jumlah_produk' => 1,
            ],
            [
                'id_akun' => 2,
                'id_produk' => 2,
                'jumlah_produk' => 3,
            ],
            [
                'id_akun' => 3,
                'id_produk' => 4,
                'jumlah_produk' => 1,
            ],
            [
                'id_akun' => 3,
                'id_produk' => 2,
                'jumlah_produk' => 1,
            ],
            [
                'id_akun' => 1,
                'id_produk' => 3,
                'jumlah_produk' => 2,
            ],
        ]);
    }
}
