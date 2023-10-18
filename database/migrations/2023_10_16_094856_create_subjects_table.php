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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->string('sub_name');
            $table->string('sub_code')->unique();
            $table->longText('sub_note');
            $table->timestamps();

              // Define the foreign key relationship
              $table->foreign('class_id')
              ->references('id')
              ->on('classnames')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            // Remove the foreign key column
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
        });
    }
};
