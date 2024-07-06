<?php

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
        Schema::create('citizen_payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable()->unique();
            $table->foreignIdFor(Citizen::class)->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('email')->nullable();
            $table->string('amount')->nullable();

            // === Bank Details
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();

            $table->integer('payment_mode')->nullable()->comment('1 => Cash, 2 => Cheque, 3 => Online Transfer, 4 => GooglePay, 5 => PhonePay');
            $table->integer('transaction_status')->default(1)->comment('1 => Pending, 2 => Paid, 3 => Cancelled');
            $table->date('transaction_date')->nullable();
            $table->time('transaction_time')->nullable();
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('citizen_payments');
    }
};
