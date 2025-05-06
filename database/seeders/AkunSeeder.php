<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AkunSeeder extends Seeder
{
    public function run()
    {
        DB::table('akuns')->insert([
            [
                'email' => 'admin@gmail.com',
                'id_role' => 1,
                'id_alamat' => 1,
                'nama' => 'Admin User',
                'password' => bcrypt('admin01'),
                'username' => 'admin01',
                'no_hp' => '081234567890',
            ],
            [
                'email' => 'customer@gmail.com',
                'id_role' => 2,
                'id_alamat' => 2,
                'nama' => 'Customer User',
                'password' => bcrypt('customer01'),
                'username' => 'customer01',
                'no_hp' => '082345678901',
            ],
            [
                'email' => 'Excaliburn123@gmail.com',
                'id_role' => 2,
                'id_alamat' => 3,
                'nama' => 'Staff User',
                'password' => bcrypt('staff01'),
                'username' => 'staff01',
                'no_hp' => '083456789012',
            ],
        ]);
    }
}
