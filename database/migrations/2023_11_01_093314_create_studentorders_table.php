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
        Schema::create('studentorders', function (Blueprint $table) {
            $table->id();
            $table->string('guard')->default('admin');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('studentpackage_id');
            $table->string('studentorder_date');
            $table->string('studentorder_code')->unique();
            $table->string('studentpackage_name');
            $table->string('studentpackage_price');
            $table->string('studentorder_card_type');
            // $table->string('studentorder_tran_id');
            $table->string('nagadTranId')->nullable();
            $table->string('bkashTranId')->nullable();            
            $table->string('studentorder_name');
            $table->string('studentorder_phone');
            $table->string('studentorder_email');
            $table->string('studentorder_address');
            $table->string('studentorder_zipcode')->nullable();
            $table->string('studentorder_city')->nullable();
            $table->string('studentorder_status')->default(1);
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
        Schema::dropIfExists('studentorders');
    }
};
