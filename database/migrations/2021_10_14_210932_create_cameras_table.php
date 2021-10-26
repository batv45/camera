<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamerasTable extends Migration
{
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('identity');
            $table->string('dir');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cameras');
    }
}
