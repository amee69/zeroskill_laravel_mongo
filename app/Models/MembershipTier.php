<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoModel; // Use MongoDB's Eloquent model

class MembershipTier extends MongoModel
{
    protected $connection = 'mongodb'; // Specify MongoDB connection
    protected $collection = 'membershiptier'; // Specify MongoDB collection name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tier_name',     // Tier name (e.g., Gold, Silver, Platinum)
        'price',         // Price for the tier
        'period',        // Number of days the membership is valid for
        'description',   // Description of the tier
    ];

    /**
     * Get the memberships for the tier.
     * Note: In MongoDB, this relationship is simulated, as there is no direct join support.
     */
    public function memberships()
    {
        // This will simulate a "hasMany" relationship by querying the Membership model.
        return $this->hasMany(Membership::class, 'tier_id');
    }
}
