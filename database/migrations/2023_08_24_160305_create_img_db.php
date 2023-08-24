<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('intro_img', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('path');
            $table->timestamps();
        });
        Schema::create('about_img', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('path');
            $table->timestamps();
        });
        Schema::create('retail_img', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('path');
            $table->timestamps();
        });
        Schema::create('location_img', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intro_img');
        Schema::dropIfExists('about_img');
        Schema::dropIfExists('retail_img');
        Schema::dropIfExists('location_img');
    }
};
