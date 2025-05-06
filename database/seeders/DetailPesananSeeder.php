<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPesananSeeder extends Seeder
{
    public function run()
    {
        DB::table('detail_pesanans')->insert([
            [
                'id_pesanan' => 1,
            ],
            [
                'id_pesanan' => 2,
            ],
            [
                'id_pesanan' => 3,
            ],
            [
                'id_pesanan' => 4,
            ],
            [
                'id_pesanan' => 5,
            ],
        ]);
    }
}
