<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('riwayat_transaksies')->insert([
            ['id_detail' => 1],
            ['id_detail' => 2],
            ['id_detail' => 3],
            ['id_detail' => 4],
            ['id_detail' => 5],
            ['id_detail' => 6],
            ['id_detail' => 7],
            ['id_detail' => 8],
            ['id_detail' => 9],
            ['id_detail' => 10],
            ['id_detail' => 11],
            ['id_detail' => 12],
            ['id_detail' => 13],
            ['id_detail' => 14],
            ['id_detail' => 15],
            ['id_detail' => 16],
            ['id_detail' => 17],
            ['id_detail' => 18],
            ['id_detail' => 19],
            ['id_detail' => 20],
            ['id_detail' => 21],
            ['id_detail' => 22],
            ['id_detail' => 23],
            ['id_detail' => 24],
            ['id_detail' => 25],
            ['id_detail' => 26],
            ['id_detail' => 27],
        ]);
    }
}
