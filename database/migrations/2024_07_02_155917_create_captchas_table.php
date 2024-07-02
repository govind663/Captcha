<?php

use App\Models\CaptchaType;
use App\Models\User;
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
        Schema::create('captchas', function (Blueprint $table) {
            $table->id();
            // add user id as foreignIdFor
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(CaptchaType::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('captcha_length')->nullable();
            $table->string('captcha_code')->nullable();
            $table->integer('is_active')->nullable()->comment('1 => Active, 0 => Deactive')->default(1);
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
        Schema::dropIfExists('captchas');
    }
};
