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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('guard')->default('admin');
            $table->string('exam_name');
            $table->string('exam_code')->unique();
            $table->string('exam_type')->default('PAID');
            $table->longText('exam_desc')->nullable();
            $table->string('class_code');
            $table->string('sub_code');
            $table->integer('total_qc');
        
            // New field for exam duration in minutes
            $table->integer('duration_minutes')->default(60); // Set a default duration if needed
        
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
};
