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
        Schema::table('recharge', function (Blueprint $table) {
            $table->boolean('bill')->nullable();
            $table->boolean('show')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recharge', function (Blueprint $table) {
            $table->dropColumn('bill');
            $table->dropColumn('read');
        });
    }
};
