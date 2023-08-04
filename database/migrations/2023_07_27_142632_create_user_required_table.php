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
        Schema::create('wallet_activities', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('amount');
            $table->string('type');
            $table->string('before');
            $table->string('after');
            $table->string('reason')->nullable();
            $table->timestamps();
        });

        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('order')->nullable();
            $table->string('status')->default(1);
            $table->timestamps();
        });

        Schema::create('user_bank', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('bank_id');
            $table->string('card_number');
            $table->string('card_holder');
            $table->timestamps();
        });

        Schema::create('recharge', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('amount');
            $table->string('before');
            $table->string('after');
            $table->string('note')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::create('withdraw', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('bank');
            $table->string('card_number');
            $table->string('card_holder');
            $table->string('amount');
            $table->string('before');
            $table->string('after');
            $table->string('note')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('wallet_activities');
        Schema::dropIfExists('withdraw');
        Schema::dropIfExists('recharge');
        Schema::dropIfExists('recharge');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('user_bank');
    }
};
