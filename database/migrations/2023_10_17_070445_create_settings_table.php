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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('address');
            $table->string('contact_no');
            $table->string('mail');
            $table->string('about_us')->nullable();
            $table->string('about_us_image')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('youtube_link')->nullable();
            
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
        Schema::dropIfExists('settings');
    }
};
