<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            
            $table->increments('id');
            
            $table->string('name');
            
            $table->integer('subject_id');
            
            $table->integer('teacher_id');
            
            $table->integer('class_id');
            
            $table->string('period');
            
            $table->string('year');
            
            $table->integer('from_user');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
