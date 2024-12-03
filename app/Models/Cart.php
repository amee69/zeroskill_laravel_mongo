<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoModel; // Use MongoDB Eloquent Model

class Cart extends MongoModel
{
    /**
     * Specify the MongoDB connection.
     *
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * Specify the collection name.
     *
     * @var string
     */
    protected $collection = 'carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',          // ID of the user who owns the cart
        'items',            // Embedded array of cart items
        'total_cart_price', // Total price of the cart
        'created_at',       // Creation timestamp
        'updated_at',       // Last update timestamp
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'items' => 'array', // Cast the 'items' field as an array || Commented this because for some reason , either laravel or mongodb is treatong this as an 
        // string instead of an array
        'total_cart_price' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Retrieve the user associated with this cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
