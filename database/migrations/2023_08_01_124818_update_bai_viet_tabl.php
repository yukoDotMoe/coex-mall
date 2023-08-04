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
        Schema::table('bai_viet', function (Blueprint $table) {
            $table->integer('danh_muc');
            $table->integer('price');
            $table->integer('vote')->default(0);
            $table->integer('like')->default(0);
            $table->string('small_title');
            $table->string('post_id');
            $table->integer('earn_vote')->nullable()->change();
            $table->integer('earn_like')->nullable()->change();
        });

        Schema::create('interactions_activities', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('amount');
            $table->integer('interact_type');
            $table->integer('before');
            $table->integer('after');
            $table->integer('type');
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bai_viet', function (Blueprint $table) {
            $table->dropColumn('danh_muc');
            $table->dropColumn('price');
            $table->dropColumn('vote');
            $table->dropColumn('like');
            $table->dropColumn('small_title');
            $table->dropColumn('post_id');
            $table->integer('earn_vote')->change();
            $table->integer('earn_like')->change();
        });

        Schema::dropIfExists('interactions_activities');
    }
};
