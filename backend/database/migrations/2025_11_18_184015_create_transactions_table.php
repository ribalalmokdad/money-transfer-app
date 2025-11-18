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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15, 2);
            $table->decimal('fee', 10, 2)->default(0.00);
            $table->string('status')->default('pending')->index();
            $table->string('reference_code', 32)->unique();
            $table->string('transaction_typ')->index();
            $table->text('refund_reason')->nullable();
            $table->string('refund_status')->default('none')->index();
            $table->timestamps();

            // Foreign Keys
            $table->foreignId('refund_approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('currency_id')->constrained('currencies')->onDelete('restrict');
            $table->foreignId('sender_account_id')->nullable()->constrained('accounts')->onDelete('restrict');
            $table->foreignId('receiver_account_id')->nullable()->constrained('accounts')->onDelete('restrict');
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
