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
        Schema::table('citizens', function (Blueprint $table) {
            // === Bank Details
            $table->string('bank_name')->nullable()->after('payment_type');
            $table->string('branch_name')->nullable()->after('bank_name');
            $table->string('account_holder_name')->nullable()->after('branch_name');
            $table->string('account_number')->nullable()->after('account_holder_name');
            $table->string('ifsc_code')->nullable()->after('account_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            // == drop column
            $table->dropColumn('bank_name');
            $table->dropColumn('branch_name');
            $table->dropColumn('account_holder_name');
            $table->dropColumn('account_number');
            $table->dropColumn('ifsc_code');
        });
    }
};
