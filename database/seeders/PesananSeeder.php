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

            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(3)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 2, 'tanggal' => Carbon::now()->subDays(2)],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(15)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(23)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(32)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(35)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(33)],

            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 2, 'tanggal' => Carbon::now()],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(6)],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(17)],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(24)],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(26)],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(27)],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(34)],
            ['id_akun' => 2, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(36)],

            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 3, 'id_metode' => 2, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 2, 'tanggal' => Carbon::now()->subDays(2)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(20)],
            ['id_akun' => 3, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(28)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(39)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(10)],
            ['id_akun' => 3, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(38)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(29)],
        ]);
    }
}
