<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoModel; // Use MongoDB's Eloquent model

class Product extends MongoModel
{
    /**
     * Specify the MongoDB connection and collection.
     */
    protected $connection = 'mongodb'; // Specify MongoDB connection
    protected $collection = 'products'; // Specify MongoDB collection name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',   // Product name
        'description',    // Product description
        'price',          // Product price
        'stock',          // Product stock count
        'category_id',    // Foreign key to categories table (for referencing)
        'images',         // Embedded images array
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id'); // Reference to Category
    }
}
