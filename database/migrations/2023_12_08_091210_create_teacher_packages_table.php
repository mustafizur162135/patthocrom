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
        Schema::create('teacher_packages', function (Blueprint $table) {
            $table->id();
            $table->string('teacherpackage_name')->unique();
            $table->string('teacherpackage_price');
            $table->string('teacherpackage_des')->nullable();
            $table->string('teacherpackage_image')->nullable();
            $table->string('no_of_question_print')->nullable();
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
        Schema::dropIfExists('teacher_packages');
    }
};
