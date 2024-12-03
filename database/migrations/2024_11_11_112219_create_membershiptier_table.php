<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershiptierTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('membershiptier', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('tier_name');  // Tier name (e.g., "Silver", "Gold", "Platinum")
            $table->text('description')->nullable();  // Description of the tier
            $table->decimal('price', 8, 2);  // Price for this membership tier
            $table->integer('period');  // Number of days the membership is valid for
            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membershiptier');
    }
}
