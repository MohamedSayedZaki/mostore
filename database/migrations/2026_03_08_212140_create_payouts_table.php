<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();

            // Link to the Ambassador receiving the funds
            $table->foreignId('ambassador_id')
                  ->constrained('ambassadors');

            // DECIMAL(15, 2) to match your financial precision
            $table->decimal('amount', 15, 2);

            // Method used (e.g., 'Bank Transfer', 'InstaPay', 'PayPal')
            $table->char('payout_method', 1)
                    ->comment('Payout method: b = Bank Transfer, i = InstaPay, p = PayPal, etc.');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
