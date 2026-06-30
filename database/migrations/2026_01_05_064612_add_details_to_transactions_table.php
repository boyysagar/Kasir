<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Menambahkan kolom baru
            $table->enum('payment_method', ['cash', 'qris'])->default('cash')->after('invoice_code');
            $table->enum('order_type', ['dine_in', 'take_away'])->default('dine_in')->after('payment_method');
            $table->string('customer_name')->nullable()->after('order_type');
            $table->string('table_number')->nullable()->after('customer_name');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'order_type', 'customer_name', 'table_number']);
        });
    }
};