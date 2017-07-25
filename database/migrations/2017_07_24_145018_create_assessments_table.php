<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            
            $table->increments('id');

            $table->integer('exam_id')->unsigned()->index();

            $table->string('name')->index();

            $table->double('out_of')->nullable()->index();

            $table->double('contribution')->index();

            $table->integer('status')->unsigned()->index();

            $table->integer('from_user')->unsigned()->index();

            $table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('assessments');
    }
}
