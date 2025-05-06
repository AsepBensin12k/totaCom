<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provinsis', function (Blueprint $table) {
            $table->id('id_provinsi');  // ID untuk referensi
            $table->string('kode_provinsi')->unique();  // Kode provinsi sesuai API
            $table->string('nama_provinsi')->unique();  // Nama provinsi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provinsis');
    }
};
