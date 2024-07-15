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
            // add  per_captcha_amt and request_amount after citizen_id
            $table->string('per_captcha_amt')->after('citizen_id');
            $table->string('request_amount')->after('per_captcha_amt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizen_payments', function (Blueprint $table) {
            // drop per_captcha_amt and request_amount columns
            $table->dropColumn('per_captcha_amt');
            $table->dropColumn('request_amount');
        });
    }
};
