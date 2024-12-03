<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $table = 'membership';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',         // Link to the user
        'tier_id',         // Link to the membership tier
        'start_date',      // Start date of the membership
        'end_date',        // End date of the membership
        'membership_status', // Status of the membership (Active or Expired)
    ];

    /**
     * Get the membership tier associated with the membership.
     */
    public function tier()
    {
        return $this->belongsTo(MembershipTier::class, 'tier_id');
    }

    /**
     * Get the user that owns the membership.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
