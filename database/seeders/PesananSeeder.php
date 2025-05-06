<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    public function run()
    {
        DB::table('pesanans')->insert([
            [
                'id_akun' => 2,
                'id_metode' => 1,
                'id_keranjang' => 1,
                'id_status' => 1,
                'tanggal' => now(),
            ],
            [
                'id_akun' => 3,
                'id_metode' => 2,
                'id_keranjang' => 3,
                'id_status' => 2,
                'tanggal' => now(),
            ],
            [
                'id_akun' => 2,
                'id_metode' => 1,
                'id_keranjang' => 5,
                'id_status' => 3,
                'tanggal' => now(),
            ],
            [
                'id_akun' => 2,
                'id_metode' => 1,
                'id_keranjang' => 4,
                'id_status' => 3,
                'tanggal' => now(),
            ],
            [
                'id_akun' => 1,
                'id_metode' => 2,
                'id_keranjang' => 5,
                'id_status' => 2,
                'tanggal' => now(),
            ],

        ]);

    }
}
