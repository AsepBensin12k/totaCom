<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id('id_kecamatan');
            $table->string('kode_kecamatan')->unique();
            $table->string('nama_kecamatan');

            $table->unsignedBigInteger('id_kabupaten')->nullable()->default(1);
            $table->foreign('id_kabupaten')->references('id_kabupaten')->on('kabupatens')->onDelete('set null');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('kecamatans');
    }
};
