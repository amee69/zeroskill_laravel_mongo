<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipTier;
use Illuminate\Support\Facades\Auth;


use Carbon\Carbon; // Make sure to import Carbon for date manipulation
use App\Models\Membership;
use App\Models\User;


class PurchaseMembershipController extends Controller
{
    public function index(Request $request)
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        // Retrieve the 'tier_id' query parameter
        $tierId = $request->query('tier_id');
    
        // Check if 'tier_id' exists and is valid
        if (!$tierId) {
            return redirect()->route('home')->with('error', 'Please select a membership tier.');
        }
    
        // Find the membership tier in the database
        $membershipTier = MembershipTier::find($tierId);
    
        // If no membership tier is found, redirect with an error message
        if (!$membershipTier) {
            return redirect()->route('home')->with('error', 'Invalid membership tier selected.');
        }
    
        // Pass the tier to the view if everything is valid
        return view('membership.membershippurchase', compact('membershipTier'));
    }
    

//This is the process payment, as in when you click the purchase button



public function purchaseProcess(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $tierId = $request->input('tier_id');

    // Find the membership tier
    $membershipTier = MembershipTier::find($tierId);

    if (!$membershipTier) {
        return redirect()->back()->with('error', 'Membership tier not found.');
    }

    // Calculate start and end dates
    $startDate = Carbon::now();
    $endDate = $startDate->copy()->addDays($membershipTier->period);

    // Update the user document
    User::where('_id', Auth::id())->update([
        'membership' => [
            'tier_id' => (string) $membershipTier->_id, // Save the tier ID as a string
            'start_date' => $startDate->toISOString(), // Ensure the date is stored in ISO format
            'end_date' => $endDate->toISOString(),     // Ensure the date is stored in ISO format
            'status' => 'Active',
        ],
    ]);

    // Redirect with success message
    return redirect()->route('membership')->with('success', 'Membership purchased successfully!');
}








}
