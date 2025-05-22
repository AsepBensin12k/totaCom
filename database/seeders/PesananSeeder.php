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
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now()],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 2, 'tanggal' => Carbon::now()->subDays(3)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 2, 'tanggal' => Carbon::now()->subDays(6)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(10)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(22)],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(35)],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(53)],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(77)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(98)],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(139)],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(157)],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(164)],
        ]);
    }
}
