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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('transaction_id')->unique()->nullable(); // Payment transaction ID from the payment gateway
            $table->string('payment_gateway'); // Payment method (e.g. Stripe, Paymob, or cash)
            $table->decimal('amount', 10, 2); // Amount paid for this transaction
            $table->string('payment_type')->default('deposit'); // Payment type: deposit or full payment
            $table->string('status')->default('pending'); // 'pending', 'successful', 'failed', 'refunded'
            $table->json('payload')->nullable(); // Saves the webhook response for later use
            $table->timestamps();

            $table->index(['booking_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
