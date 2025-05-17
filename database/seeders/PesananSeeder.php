<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    public function run()
    {
        DB::table('pesanans')->insert([

            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(3)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 2, 'tanggal' => Carbon::now()->subDays(2)],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(15)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(23)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(72)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(15)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(233)],

            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(6)],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(117)],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(24)],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(36)],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(57)],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(64)],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(76)],

            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 3, 'id_metode' => 2, 'id_status' => 2, 'tanggal' => Carbon::now()],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(2)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(70)],
            ['id_akun' => 3, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(88)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(99)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(90)],
            ['id_akun' => 3, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(138)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(129)],
        ]);
    }
}
