<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Kabupaten;
use App\Models\Provinsi;

class KabupatenSeeder extends Seeder
{
    public function run(): void
    {
        $provinsi = Provinsi::where('kode_provinsi', 35)->first();
        if (!$provinsi) {
            Log::error('Provinsi dengan kode 35 tidak ditemukan.');
            return;
        }

        $response = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/regencies/35.json');

        if ($response->successful()) {
            $kabupatenData = $response->json();

            if (is_array($kabupatenData)) {
                foreach ($kabupatenData as $item) {

                    Kabupaten::updateOrCreate(
                        ['kode_kabupaten' => $item['id']],
                        [
                            'nama_kabupaten' => $item['name'],
                            'id_provinsi' => $provinsi->id_provinsi
                        ]
                    );
                    Log::info('Kabupaten berhasil disimpan: ' . $item['name']);
                }
            } else {
                Log::error('Data kabupaten tidak valid: ' . json_encode($kabupatenData));
            }
        } else {
            Log::error('Gagal mendapatkan data kabupaten dari API. Status: ' . $response->status());
        }
    }
}
