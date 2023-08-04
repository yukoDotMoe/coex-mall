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
            $table->integer('limit_vote');
            $table->integer('limit_like');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bai_viet', function (Blueprint $table) {
            $table->dropColumn('limit_vote');
            $table->dropColumn('limit_like');
        });
    }
};
