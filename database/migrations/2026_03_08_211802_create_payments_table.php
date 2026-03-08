<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // Link to Order (Restrict deletion to keep financial logs)
            $table->foreignId('order_id')
                  ->constrained('orders');

            $table->decimal('amount', 15, 2);
            
            // Payment method (e.g., 'credit_card', 'paypal', 'stripe')
            $table->char('payment_method', 1)
                    ->comment('Payment method: c = Credit Card, p = PayPal, s = Stripe, etc.');
            
            // Payment status (e.g., 'captured', 'refunded', 'failed')
            $table->char('status', 1)
                    ->default('c')
                    ->comment('Payment status: c = Captured, r = Refunded, f = Failed, etc.');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
