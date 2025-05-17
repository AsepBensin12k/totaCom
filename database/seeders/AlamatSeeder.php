<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alamat;

class AlamatSeeder extends Seeder
{
    public function run(): void
    {
        Alamat::create([
            'detail_alamat' => 'Perumahan Tegal Besar Permai 1, Blok P-4',
            'id_kecamatan' => 1,
            'id_kabupaten' => 9,
            'id_provinsi' => 15,
        ]);

        Alamat::create([
            'detail_alamat' => 'Jl. Letjend Suprapto',
            'id_kecamatan' => 2,
            'id_kabupaten' => 9,
            'id_provinsi' => 15,
        ]);

        Alamat::create([
            'detail_alamat' => 'Jl. Jawa',
            'id_kecamatan' => 3,
            'id_kabupaten' => 9,
            'id_provinsi' => 15,
        ]);
    }
}
