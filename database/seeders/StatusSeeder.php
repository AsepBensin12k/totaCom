<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert([
            ['nama_status' => 'dikemas'],
            ['nama_status' => 'dikirim'],
            ['nama_status' => 'selesai'],
        ]);
    }
}
