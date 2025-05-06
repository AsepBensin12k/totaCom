<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiSeeder extends Seeder
{
    public function run()
    {
        DB::table('riwayat_transaksies')->insert([
            [
                'id_detail' => 1,
            ],
            [
                'id_detail' => 2,
            ],
            [
                'id_detail' => 3,
            ],
            [
                'id_detail' => 4,
            ],
            [
                'id_detail' => 5,
            ],
        ]);
    }
}
