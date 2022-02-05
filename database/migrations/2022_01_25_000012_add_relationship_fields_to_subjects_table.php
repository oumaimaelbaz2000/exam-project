<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubjectsTable extends Migration
{
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('certificats_id')->nullable();
            $table->foreign('certificats_id', 'certificats_fk_5835627')->references('id')->on('certificats');
        });
    }
}
