<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akuns', function (Blueprint $table) {
            $table->id('id_akun');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp')->unique();
            $table->unsignedBigInteger('id_role')->default(2);
            $table->unsignedBigInteger('id_alamat');
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');
            $table->foreign('id_alamat')->references('id_alamat')->on('alamats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akuns');
    }
};
