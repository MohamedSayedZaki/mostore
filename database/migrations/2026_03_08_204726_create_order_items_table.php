<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Link to Order with Cascade Delete
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->onDelete('cascade');

            // Link to Product (Restricted delete to preserve order history)
            $table->foreignId('product_id')
                  ->constrained('products');

            $table->integer('quantity');

            // Capturing the price at the moment of sale
            $table->decimal('price_at_purchase', 15, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
