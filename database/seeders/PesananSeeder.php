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

            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(164), 'bukti_pembayaran' => 'bukti/BP-PSN001.jpg'],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(157), 'bukti_pembayaran' => 'bukti/BP-PSN002.jpg'],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(139), 'bukti_pembayaran' => null],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(98), 'bukti_pembayaran' => null],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(77), 'bukti_pembayaran' => null],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(53), 'bukti_pembayaran' => null],
            ['id_akun' => 1, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(35), 'bukti_pembayaran' => null],
            ['id_akun' => 1, 'id_metode' => 2, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(22), 'bukti_pembayaran' => null],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 3, 'tanggal' => Carbon::now()->subDays(10), 'bukti_pembayaran' => 'bukti/BP-PSN009.jpg'],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 2, 'tanggal' => Carbon::now()->subDays(6), 'bukti_pembayaran' => 'bukti/BP-PSN010.jpg'],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 2, 'tanggal' => Carbon::now()->subDays(3), 'bukti_pembayaran' => 'bukti/BP-PSN011.jpg'],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now(), 'bukti_pembayaran' => 'bukti/BP-PSN012.jpg'],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now(), 'bukti_pembayaran' => 'bukti/BP-PSN013.jpg'],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now(), 'bukti_pembayaran' => 'bukti/BP-PSN014.jpg'],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now(), 'bukti_pembayaran' => 'bukti/BP-PSN015.jpg'],
            ['id_akun' => 3, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now(), 'bukti_pembayaran' => 'bukti/BP-PSN016.jpg'],
            ['id_akun' => 2, 'id_metode' => 1, 'id_status' => 1, 'tanggal' => Carbon::now(), 'bukti_pembayaran' => 'bukti/BP-PSN017.jpg'],

        ]);
    }
}
