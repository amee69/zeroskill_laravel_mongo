<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');  // Foreign key to carts table
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Foreign key to products table
            $table->integer('quantity')->default(1);  // Quantity of the product in the cart
            $table->decimal('price', 10, 2);  // Price at the time the item was added
            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
}
