<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenTable extends Migration
{
    public function up()
    {
        Schema::create('examen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->time('duration');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
