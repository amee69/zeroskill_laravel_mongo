<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MembershipTier;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch the user's membership information directly from the embedded data in the user's document
        $membershipData = $user->membership ?? null;

        // Initialize tier name as null
        $tierName = null;

        // If membership data exists, fetch the tier name
        if ($membershipData && isset($membershipData['tier_id'])) {
            $tier = MembershipTier::find($membershipData['tier_id']);
            $tierName = $tier ? $tier->tier_name : '?';
        }

        // Get the user's role directly from the 'role' field in the user's document
        $role = $user->role ?? 'N/A';

        

        // Pass the data to the profile view
        return view('profile.show', [
            'user' => $user,
            'membershipData' => $membershipData,
            'tierName' => $tierName,
            'role' => $role,
        ]);
    }
}
