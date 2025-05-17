<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePembayaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('metode_pembayarans')->insert([
            ['nama_metode' => 'Midtrans'],
            ['nama_metode' => 'Cash on Delivery'],
        ]);
    }
}
