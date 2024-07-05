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
            // ==== Backup Password after password
            $table->string('backup_password')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            // ==== Drop Backup Password
            $table->dropColumn('backup_password');
        });
    }
};
