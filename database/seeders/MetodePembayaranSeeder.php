<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePembayaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('metode_pembayarans')->insert([
            ['nama_metode' => 'Transfer Bank'],
            ['nama_metode' => 'E-Wallet'],
            ['nama_metode' => 'Cash on Delivery'],
        ]);
    }
}
