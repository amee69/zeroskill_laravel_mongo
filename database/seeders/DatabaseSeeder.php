<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MembershipTier;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membership tiers seeder
        // $this->call(MembershipTierSeeder::class);

        // $this->call(CategoriesSeeder::class);

        $this->call(ProductsSeeder::class);



        // Uncomment this section if you want to seed the admin user
        /*
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Check if an admin already exists by email
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com', // Updated admin email
                'number' => '9999999999', // Example admin contact number
                'nic' => 'ADMIN123456', // Example NIC
                'address' => 'Admin Headquarters', // Example address
                'password' => Hash::make('admin123'), // Hash the password
                'role' => 'admin', // Assign role as 'admin'
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        */

        // Other commented parts remain untouched
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
