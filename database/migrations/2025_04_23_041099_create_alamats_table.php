<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alamats', function (Blueprint $table) {
            $table->id('id_alamat');
            $table->string('alamat');
            $table->unsignedBigInteger('id_kecamatan');
            $table->unsignedBigInteger('id_kabupaten');
            $table->unsignedBigInteger('id_provinsi');
            $table->timestamps();

            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('kecamatans')->onDelete('cascade');
            $table->foreign('id_kabupaten')->references('id_kabupaten')->on('kabupatens')->onDelete('cascade');
            $table->foreign('id_provinsi')->references('id_provinsi')->on('provinsis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alamats');
    }
};
