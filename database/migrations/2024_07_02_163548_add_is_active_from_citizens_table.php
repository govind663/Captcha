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
            // add is_active column after captcha_type_id
            $table->boolean('is_active')->default(true)->after('captcha_type_id')->comment('Inactive: 0, Active: 1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            // drop is_active column
            $table->dropColumn('is_active');
        });
    }
};
