<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKcpesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kcpes', function (Blueprint $table) {

            $table->increments('id');
            
            $table->integer('student_id')->unsigned()->index();
            
            $table->string('marks')->index();
            
            $table->integer('position')->unsigned()->index();
            
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
        Schema::dropIfExists('kcpes');
    }
}
