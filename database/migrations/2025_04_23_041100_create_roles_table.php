<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{

    public function up():void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('role')->unique();
            $table->timestamps();
        });
    }

    public function down():void
    {
        Schema::dropIfExists('roles');
    }
}
