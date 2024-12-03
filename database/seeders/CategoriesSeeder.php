<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Import the Category model
use Carbon\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Current timestamp
        $now = Carbon::now();

        // Categories data
        $categories = [
            [
                'category_name' => 'Protein Powder',
                'description' => 'High-quality protein powders to support muscle recovery and growth.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_name' => 'Creatine',
                'description' => 'Boost strength and performance with premium creatine products.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_name' => 'Pre Workouts',
                'description' => 'Energize your workouts with powerful pre-workout formulas.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_name' => 'Vitamins & Fish Oils',
                'description' => 'Essential vitamins and omega-3 fish oils for overall health and wellness.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_name' => 'Mass Gainers',
                'description' => 'Effective mass gainers to help you achieve your fitness goals.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_name' => 'BCAAs',
                'description' => 'Enhance muscle recovery and endurance with top-quality BCAAs.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_name' => 'Protein Bar & Energy Drinks',
                'description' => 'Delicious protein bars and energy drinks for on-the-go nutrition.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'category_name' => 'Zero Skill Merch',
                'description' => 'Exclusive Zero Skill merchandise for fitness enthusiasts.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Insert categories into the MongoDB collection
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
