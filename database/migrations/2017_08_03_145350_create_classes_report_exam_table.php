<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesReportExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_report_exam', function (Blueprint $table) {
            
            $table->integer('exam_id')->unsigned()->index();

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            
            $table->integer('classes_report_id')->unsigned()->index();

            $table->foreign('classes_report_id')->references('id')->on('classes_reports')->onDelete('no action');

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
        Schema::dropIfExists('classes_report_exam');
    }
}
