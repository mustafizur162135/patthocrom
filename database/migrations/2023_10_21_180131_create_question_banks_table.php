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
            $table->longText('question_name');
            $table->longText('question_option_1');
            $table->longText('question_option_2');
            $table->longText('question_option_3')->nullable();
            $table->longText('question_option_4')->nullable();
            $table->longText('question_option_5')->nullable();
            $table->longText('question_option_6')->nullable();
            $table->longText('question_correct_ans');
            $table->string('question_default_marks');
            $table->string('question_default_time_to_solve');
            $table->string('question_hint')->nullable();
            $table->string('question_solution')->nullable();
            $table->string('visibility')->nullable();
            $table->tinyInteger('is_paid');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('question_type_code')->references('question_type_code')->on('question_types');
            $table->foreign('question_diff_code')->references('question_diff_level_code')->on('question_diff_levels');
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
