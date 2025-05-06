<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\KecamatanSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            ProvinsiSeeder::class,

            KabupatenSeeder::class,

            KecamatanSeeder::class,

            AlamatSeeder::class,

            RolesSeeder::class,

            AkunSeeder::class,

            JenisSeeder::class,

            StatusSeeder::class,

            MetodePembayaranSeeder::class,

            ProdukSeeder::class,

            KeranjangSeeder::class,

            PesananSeeder::class,

            DetailPesananSeeder::class,

            RiwayatTransaksiSeeder::class,
        ]);
    }
}
