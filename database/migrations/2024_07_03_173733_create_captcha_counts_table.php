<?php

use App\Models\Captcha;
use App\Models\Citizen;
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
        Schema::create('captcha_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Citizen::class)->nullable()->index();
            $table->foreignIdFor(Captcha::class)->nullable()->index();
            $table->integer('is_correct_captcha_count')->nullable()->comment('Number of correct captchas');
            $table->integer('is_wrong_captcha_count')->nullable()->comment('Number of wrong captchas');
            $table->integer('per_captcha_amount')->nullable();
            $table->integer('inserted_by')->nullable();
            $table->timestamp('inserted_at')->nullable();
            $table->integer('modified_by')->nullable();
            $table->timestamp('modified_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('captcha_counts');
    }
};
