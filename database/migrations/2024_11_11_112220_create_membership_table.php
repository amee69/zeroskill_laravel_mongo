<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('membership', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key linking to users table
            $table->foreignId('tier_id')->constrained('membershiptier')->onDelete('cascade');  // CASCADE Foreign key linking to membershiptier table
            $table->date('start_date');  // The start date of the membership
            $table->date('end_date');  // The end date of the membership
            $table->enum('membership_status', ['Active', 'Expired','Cancelled'])->default('Active'); // Enum for membership status
            $table->timestamps();  // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership');
    }
}
