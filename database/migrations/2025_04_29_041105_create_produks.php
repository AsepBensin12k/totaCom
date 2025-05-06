<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk')->unique();
            $table->string('gambar')->nullable();
            $table->decimal('harga', 10);
            $table->integer('stok');
            $table->unsignedBigInteger('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenises')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
