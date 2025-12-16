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
        Schema::table('store_tokens', function (Blueprint $table) {
            $table->string('vessel_name')->nullable()->after('captain_name');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('vessel_name')->nullable()->after('captain_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('store_tokens', function (Blueprint $table) {
            $table->dropColumn('vessel_name');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('vessel_name');
        });
    }
};
