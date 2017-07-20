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
            
            $table->string('name')->index();
            
            $table->integer('subject_id')->index();
            
            $table->integer('teacher_id')->index();
            
            $table->integer('stream_id')->index();
            
            $table->string('period')->index();
            
            $table->string('year')->index();
            
            $table->integer('status')->unsigned()->index();
            
            $table->integer('from_user')->unsigned()->index();
            
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
