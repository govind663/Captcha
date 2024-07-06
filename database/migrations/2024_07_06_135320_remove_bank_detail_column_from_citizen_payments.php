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
        Schema::table('citizen_payments', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('amount');
            $table->dropColumn('bank_name');
            $table->dropColumn('branch_name');
            $table->dropColumn('account_holder_name');
            $table->dropColumn('account_number');
            $table->dropColumn('ifsc_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizen_payments', function (Blueprint $table) {
            $table->string('email', 255)->after('citizen_id');
            $table->string('amount', 2555)->after('email');
            $table->string('bank_name', 255)->after('amount');
            $table->string('branch_name', 255)->after('bank_name');
            $table->string('account_holder_name', 255)->after('branch_name');
            $table->string('account_number', 255)->after('account_holder_name');
            $table->string('ifsc_code', 255)->after('account_number');
        });
    }
};
