<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Provinsi;

class ProvinsiSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        foreach ($response->json() as $item) {
            Provinsi::updateOrCreate(
                ['kode_provinsi' => $item['id']],
                ['nama_provinsi' => $item['name']]
            );
        }
    }
}
