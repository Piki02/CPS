<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('invoice_name')->nullable()->after('status');
            $table->text('invoice_address')->nullable()->after('invoice_name');
            $table->string('invoice_phone')->nullable()->after('invoice_address');
            $table->string('invoice_nit')->nullable()->after('invoice_phone');
            $table->string('invoice_zip_code')->nullable()->after('invoice_nit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'invoice_name',
                'invoice_address',
                'invoice_phone',
                'invoice_nit',
                'invoice_zip_code'
            ]);
        });
    }
};
