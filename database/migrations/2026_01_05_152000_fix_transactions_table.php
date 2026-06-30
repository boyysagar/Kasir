<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'invoice_code')) {
                $table->string('invoice_code')->unique()->after('total_price');
            }
            if (!Schema::hasColumn('transactions', 'payment_method')) {
                $table->enum('payment_method', ['cash', 'qris'])->default('cash')->after('invoice_code');
            }
            if (!Schema::hasColumn('transactions', 'order_type')) {
                $table->enum('order_type', ['dine_in', 'take_away'])->default('dine_in')->after('payment_method');
            }
            if (!Schema::hasColumn('transactions', 'customer_name')) {
                $table->string('customer_name')->nullable()->after('order_type');
            }
            if (!Schema::hasColumn('transactions', 'table_number')) {
                $table->string('table_number')->nullable()->after('customer_name');
            }
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Kita tidak drop kolom di sini untuk keamanan, atau bisa kita tambahkan logic drop jika ada
        });
    }
};
