<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoModel; // Use MongoDB's Eloquent model

class Category extends MongoModel
{
    /**
     * Specify the MongoDB connection and collection.
     */
    protected $connection = 'mongodb'; // Specify MongoDB connection
    protected $collection = 'categories'; // Specify MongoDB collection name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the products for the category.
     * 
     * This simulates a "hasMany" relationship using the `category_id` field.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id'); // Reference field: category_id
    }
}
