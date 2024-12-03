<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // For MongoDB connection
use App\Models\MembershipTier;

class MembershipController extends Controller
{
    /**
     * Display the membership page.
     */
    public function index()
    {
        // Fetch all membership tiers (this remains unchanged)
        $membershipTiers = MembershipTier::all();

        // Check if the user has an active membership by querying the 'users' collection
        $membershipStatus = DB::connection('mongodb')
            ->table('users')
            ->where('_id', Auth::id())
            ->value('membership');

        return view('membership.membership', compact('membershipTiers', 'membershipStatus'));
    }
}
