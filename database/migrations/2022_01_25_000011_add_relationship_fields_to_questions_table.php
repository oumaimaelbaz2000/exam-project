<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQuestionsTable extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('subjects_id')->nullable();
            $table->foreign('subjects_id', 'subjects_fk_5835632')->references('id')->on('subjects');
        });
    }
}
