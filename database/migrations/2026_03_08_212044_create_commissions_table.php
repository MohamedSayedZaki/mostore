<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            
            // Ambassador Relationship
            $table->foreignId('ambassador_id')
                  ->constrained('ambassadors');

            // Link to the specific order that generated this commission
            $table->foreignId('order_id')
                  ->constrained('orders');

            $table->decimal('amount', 15, 2);
            
            // Status: Accrued, Paid, Cancelled, etc.
            $table->char('status', 1)
                    ->default('a')
                    ->comment('Commission status: a = Accrued, p = Paid, c = Cancelled, etc.');

            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
