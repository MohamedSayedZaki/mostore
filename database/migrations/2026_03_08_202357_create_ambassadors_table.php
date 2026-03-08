<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ambassadors', function (Blueprint $table) {
            $table->id();
            
            // Link to the users table
            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('referral_code', 50)->unique();
            
            // DECIMAL(5, 2) -> 999.99
            $table->decimal('commission_rate', 5, 2)->default(0.10);
            
            // DECIMAL(15, 2) -> 9,999,999,999,999.99
            $table->decimal('total_earnings', 15, 2)->default(0.00);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ambassadors');
    }
};
