<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DetailPesananSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('detail_pesanans')->insert([
            ['id_pesanan' => 1,  'id_produk' => 1, 'qty' => 5, 'harga' => 7000000, 'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 2,  'id_produk' => 3, 'qty' => 6, 'harga' => 50000,   'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 3,  'id_produk' => 4, 'qty' => 7, 'harga' => 900000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 4,  'id_produk' => 6, 'qty' => 3, 'harga' => 200000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 5,  'id_produk' => 5, 'qty' => 2, 'harga' => 300000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 6,  'id_produk' => 2, 'qty' => 1, 'harga' => 150000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 7,  'id_produk' => 8, 'qty' => 6, 'harga' => 75000,   'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 8,  'id_produk' => 7, 'qty' => 9, 'harga' => 500000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 9,  'id_produk' => 9, 'qty' => 11, 'harga' => 400000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 10, 'id_produk' => 10, 'qty' => 5, 'harga' => 175000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 11, 'id_produk' => 1, 'qty' => 7, 'harga' => 7000000, 'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 12, 'id_produk' => 3, 'qty' => 8, 'harga' => 50000,   'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 13, 'id_produk' => 4, 'qty' => 9, 'harga' => 900000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 14, 'id_produk' => 2, 'qty' => 4, 'harga' => 150000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 15, 'id_produk' => 6, 'qty' => 12, 'harga' => 200000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 16, 'id_produk' => 5, 'qty' => 9, 'harga' => 300000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 17, 'id_produk' => 7, 'qty' => 7, 'harga' => 500000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 18, 'id_produk' => 8, 'qty' => 3, 'harga' => 75000,   'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 19, 'id_produk' => 9, 'qty' => 2, 'harga' => 400000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 20, 'id_produk' => 10, 'qty' => 5, 'harga' => 175000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 21, 'id_produk' => 1, 'qty' => 7, 'harga' => 7000000, 'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 22, 'id_produk' => 4, 'qty' => 3, 'harga' => 900000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 23, 'id_produk' => 2, 'qty' => 6, 'harga' => 150000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 24, 'id_produk' => 6, 'qty' => 7, 'harga' => 200000,  'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 25, 'id_produk' => 3, 'qty' => 8, 'harga' => 50000,   'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 26, 'id_produk' => 8, 'qty' => 9, 'harga' => 75000,   'created_at' => $now, 'updated_at' => $now],
            ['id_pesanan' => 27, 'id_produk' => 10, 'qty' => 13, 'harga' => 175000,  'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
