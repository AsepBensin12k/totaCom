<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    public function run()
    {
        DB::table('jenises')->insert([
            ['nama_jenis' => 'Pupuk'],
            ['nama_jenis' => 'Pestisida'],
            ['nama_jenis' => 'Benih'],
            ['nama_jenis' => 'Alat pertanian'],
        ]);
    }
}
