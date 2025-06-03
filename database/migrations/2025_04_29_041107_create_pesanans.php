<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_akun');
            $table->unsignedBigInteger('id_status');
            $table->unsignedBigInteger('id_metode');
            $table->string('bukti_pembayaran')->nullable();

            $table->foreign('id_akun')->references('id_akun')->on('akuns')->onDelete('cascade');
            $table->foreign('id_status')->references('id_status')->on('statuses')->onDelete('cascade');
            $table->foreign('id_metode')->references('id_metode')->on('metode_pembayarans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
