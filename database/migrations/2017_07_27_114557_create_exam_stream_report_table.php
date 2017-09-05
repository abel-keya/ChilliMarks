<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamStreamReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_stream_report', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('stream_report_id')->unsigned()->index();

            $table->foreign('stream_report_id')->references('id')->on('stream_reports')->onDelete('cascade');
            
            $table->integer('exam_id')->unsigned()->index();

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('no action');
            
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
        Schema::dropIfExists('exam_stream_report');
    }
}
