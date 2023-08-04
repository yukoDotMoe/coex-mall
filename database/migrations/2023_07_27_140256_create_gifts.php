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
            $table->string('name');
            $table->text('value');
            $table->timestamps();
        });

        Schema::create('danh_muc', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('bai_viet', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('title');
            $table->text('content');
            $table->integer('earn_like');
            $table->integer('earn_vote');
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('danh_gia', function (Blueprint $table) {
            $table->id();
            $table->string('post_id');
            $table->integer('user_id');
            $table->integer('vote');
            $table->timestamps();
        });

        Schema::create('yeu_thich', function (Blueprint $table) {
            $table->id();
            $table->string('post_id');
            $table->integer('user_id');
            $table->integer('likes');
            $table->timestamps();
        });

        Schema::create('hop_qua', function (Blueprint $table) {
            $table->id();
            $table->string('gift_id');
            $table->string('name');
            $table->string('ratio');
            $table->timestamps();
        });

        Schema::create('lich_su_mo_qua', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('id_qua');
            $table->integer('trang_thai')->default(0);
            $table->timestamps();
        });

        Schema::create('lich_su_danh_gia_game', function (Blueprint $table) {
            $table->id();
            $table->string('game_id');
            $table->string('gia_tri');
            $table->timestamps();
        });

        Schema::create('lich_su_danh_gia', function (Blueprint $table) {
            $table->id();
            $table->string('game_id');
            $table->string('user_id');
            $table->integer('thao_tac');
            $table->integer('so_luong');
            $table->integer('trang_thai')->default(0);
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
        Schema::dropIfExists('danh_muc');
        Schema::dropIfExists('bai_viet');
        Schema::dropIfExists('danh_gia');
        Schema::dropIfExists('yeu_thich');
        Schema::dropIfExists('hop_qua');
        Schema::dropIfExists('lich_su_mo_qua');
        Schema::dropIfExists('lich_su_danh_gia_game');
        Schema::dropIfExists('lich_su_danh_gia');
    }
};
