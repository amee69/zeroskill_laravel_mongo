<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add the missing fields to the existing users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('number', 15)->after('email'); // Adding 'number' after email
            $table->string('nic', 20)->unique()->after('number'); // Adding 'nic' after number
            $table->text('address')->nullable()->after('nic'); // Adding 'address' after nic
            $table->foreignId('role_id') // Adding 'role_id' field
                ->constrained('roles') // Assuming 'roles' table exists
                ->onDelete('restrict')
                ->after('address'); // Adding after address
        });

        // Set the default value for 'role_id' to 2
        DB::statement('ALTER TABLE users ALTER COLUMN role_id SET DEFAULT 2');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the added fields in the down method
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['number', 'nic', 'address', 'role_id']);
        });
    }
};
