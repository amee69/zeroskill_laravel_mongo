<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoModel; // Use MongoDB's Eloquent model

class Order extends MongoModel
{
    /**
     * Specify the MongoDB connection and collection.
     */
    protected $connection = 'mongodb'; // Specify MongoDB connection
    protected $collection = 'orders'; // Specify MongoDB collection name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'order_date',
        'shipping_details',
        'payment_method',
        'items',
        'cancellation_reason',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // 'shipping_details' => 'array', // Cast shipping_details as an array
        // 'items' => 'array', // Cast items as an array
        'order_date' => 'datetime', // Cast order_date as a datetime object
        'created_at' => 'datetime', // Cast created_at as a datetime object
        'updated_at' => 'datetime', // Cast updated_at as a datetime object
    ];

    /**
     * Get the user associated with the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Reference the User model
    }
}
