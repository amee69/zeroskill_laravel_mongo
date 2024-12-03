<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MembershipTier;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin.admin');
    }

    /**
     * Display members with role 'member' (role = 'member').
     */
    public function members()
    {
        // Fetch all users with a role of 'normal' and a non-empty membership field
        $members = User::where('role', 'normal')
            ->whereNotNull('membership')
            ->paginate(6);

            // dd($members);

        // Create an array to store membership tier names
        $membershipTiers = [];

        foreach ($members as $member) {
            // Check if the member has a tier_id in the membership
            $tierId = $member->membership['tier_id'] ?? null;

            if ($tierId) {
                // Find the tier name based on the tier ID
                $tier = MembershipTier::find($tierId);
                $membershipTiers[$member->id] = $tier ? $tier->tier_name : 'N/A';
            } else {
                $membershipTiers[$member->id] = 'N/A';
            }
        }

        // Pass the members and their membership tiers to the view
        return view('admin.admin-sub-views.members', compact('members', 'membershipTiers'));
    }



    /**
     * Display all membership tiers.
     */
    public function membershiptiers()
    {
        $membershiptiers = MembershipTier::all(); // Fetch all membership tiers
        return view('admin.admin-sub-views.membershiptiers', compact('membershiptiers'));
    }

    /**
     * Display all registered users (role = 'normal').
     */
    public function registeredusers()
    {
        // Fetch all users with role 'normal'
        $allusers = User::where('role', 'normal') // Adjusted to use the role field
            ->paginate(10); // Paginate the data (10 per page)

        return view('admin.admin-sub-views.registered-users', compact('allusers'));
    }



}
