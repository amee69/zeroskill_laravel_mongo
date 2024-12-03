<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->foreignId('category_id')->constrained()->onDelete('cascade');  // Foreign key to categories table
            $table->string('product_name');  // Name of the product
            $table->text('description')->nullable();  // Product description
            $table->decimal('price', 10, 2);  // Product price
            $table->integer('stock')->default(0);  // Product stock
            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
