<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipTier;

class MembershipTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MembershipTier::create([
            'tier_name' => 'Gold',
            'price' => 500.00,
            'period' => 365, // Days
            'description' => 'Premium membership with all features.',
        ]);

        MembershipTier::create([
            'tier_name' => 'Silver',
            'price' => 300.00,
            'period' => 180, // Days
            'description' => 'Standard membership with limited features.',
        ]);

        MembershipTier::create([
            'tier_name' => 'Platinum',
            'price' => 700.00,
            'period' => 730, // Days
            'description' => 'Exclusive membership with VIP access.',
        ]);
    }
}
