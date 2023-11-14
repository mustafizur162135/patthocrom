<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentpackage_exam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studentpackage_id');
            $table->unsignedBigInteger('exam_id');
            $table->timestamps();

            $table->foreign('studentpackage_id')->references('id')->on('studentpackages')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studentpackage_exam');
    }
};
