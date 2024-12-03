<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Current timestamp
        $now = Carbon::now();

        // Retrieve categories with their string IDs
        $categories = Category::all()->pluck('_id', 'category_name'); // [category_name => _id]

        // Products data
        $products = [
            [
                'product_name' => 'Whey Protein Isolate',
                'description' => 'Premium quality whey protein isolate for muscle recovery and growth.',
                'price' => 49.99,
                'stock' => 100,
                'category_id' => (string) $categories['Protein Powder'], // Convert category ID to string
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_name' => 'Creatine Monohydrate',
                'description' => 'Pure creatine monohydrate for enhanced strength and performance.',
                'price' => 19.99,
                'stock' => 200,
                'category_id' => (string) $categories['Creatine'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_name' => 'Pre-Workout Blast',
                'description' => 'Explosive pre-workout energy booster for intense workouts.',
                'price' => 29.99,
                'stock' => 150,
                'category_id' => (string) $categories['Pre Workouts'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_name' => 'Omega-3 Fish Oil',
                'description' => 'High-potency omega-3 fish oil capsules for overall health.',
                'price' => 14.99,
                'stock' => 300,
                'category_id' => (string) $categories['Vitamins & Fish Oils'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_name' => 'Mass Gainer Extreme',
                'description' => 'Calorie-dense mass gainer for bulking and strength gains.',
                'price' => 39.99,
                'stock' => 50,
                'category_id' => (string) $categories['Mass Gainers'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_name' => 'BCAA Power Blend',
                'description' => 'Branch chain amino acids to enhance recovery and endurance.',
                'price' => 24.99,
                'stock' => 120,
                'category_id' => (string) $categories['BCAAs'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_name' => 'Protein Energy Bar',
                'description' => 'Tasty protein-packed energy bars for on-the-go nutrition.',
                'price' => 2.99,
                'stock' => 500,
                'category_id' => (string) $categories['Protein Bar & Energy Drinks'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_name' => 'Zero Skill Hoodie',
                'description' => 'Stylish and comfortable hoodie from Zero Skill merch.',
                'price' => 39.99,
                'stock' => 75,
                'category_id' => (string) $categories['Zero Skill Merch'],
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        // Insert products into the database
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
