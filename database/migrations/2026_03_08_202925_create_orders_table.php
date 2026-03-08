<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Standard User Relationship
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Ambassador Relationship (Nullable with Set Null on Delete)
            $table->foreignId('ambassador_id')
                  ->nullable()
                  ->constrained('ambassadors')
                  ->onDelete('set null');

            $table->decimal('total_amount', 15, 2);
            
            // Default Status 'Pending'
            $table->char('status', 1)
                    ->default('p')
                    ->comment('Order status: p = Pending, f = Finished, c = Cancelled, etc.');
            
            // Track which code was used at the time of purchase
            $table->string('referral_code_used', 50)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
