<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Kecamatan;
use App\Models\Kabupaten;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        $kabupatenId = 9;
        $response = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/districts/3509.json');

        if ($response->successful()) {
            $kecamatanData = $response->json();
            if (is_array($kecamatanData)) {
                foreach ($kecamatanData as $item) {
                    Kecamatan::updateOrCreate(
                        ['kode_kecamatan' => $item['id']],
                        [
                            'nama_kecamatan' => $item['name'],
                            'id_kabupaten' => $kabupatenId,
                        ]
                    );
                }
            } else {
                Log::error('Data kecamatan tidak valid: ' . json_encode($kecamatanData));
            }
        } else {
            Log::error('Gagal mendapatkan data kecamatan dari API');
        }
    }
}
