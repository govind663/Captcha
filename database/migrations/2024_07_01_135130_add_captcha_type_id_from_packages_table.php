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
        Schema::table('packages', function (Blueprint $table) {
            //=== Add captchaTypeID after package_type_id
            $table->unsignedBigInteger('captcha_type_id')->after('package_type_id');

            //=== Add foreign key constraint to captcha_types table
            $table->foreign('captcha_type_id')->references('id')->on('captcha_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            //=== Drop foreign key constraint
            $table->dropForeign('packages_captcha_type_id_foreign');

            //=== Drop captcha_type_id column
            $table->dropColumn('captcha_type_id');
        });
    }
};
