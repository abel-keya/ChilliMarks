<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('exam_id')->unsigned()->index();

            $table->integer('student_id')->unsigned()->index();

            $table->double('grade')->unsigned()->index();

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
        Schema::dropIfExists('grades');
    }
}
