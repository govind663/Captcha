<?php

use App\Models\CaptchaType;
use App\Models\PackageType;
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
            $table->foreignIdFor(CaptchaType::class)->nullable()->after('name')->constrained()->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            $table->dropForeign(['captcha_type_id']);
            $table->dropColumn('captcha_type_id');
        });
    }
};
