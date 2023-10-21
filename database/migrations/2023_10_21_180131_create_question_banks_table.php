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
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id();
            $table->string('question_code')->unique();
            $table->string('class_code');
            $table->string('sub_code');
            $table->string('question_diff_code');
            $table->string('question_type_code');
            $table->string('question_name');
            $table->string('question_option_1');
            $table->string('question_option_2');
            $table->string('question_option_3');
            $table->string('question_option_4');
            $table->string('question_option_5');
            $table->string('question_option_6');
            $table->string('question_correct_ans');
            $table->string('question_default_marks');
            $table->string('question_default_time_to_solve');
            $table->string('question_hint');
            $table->string('question_solution');
            $table->string('visibility');
            $table->tinyInteger('is_paid');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('question_banks');
    }
};
