<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembershipTier;
use Illuminate\Support\Facades\Auth;
use App\Mail\MembershipConfirmation;
use Illuminate\Support\Facades\Mail;


use Carbon\Carbon; 
use App\Models\Membership;
use App\Models\User;


class PurchaseMembershipController extends Controller
{
    public function index(Request $request)
    {
       
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    
        
        $tierId = $request->query('tier_id');
    
        
        if (!$tierId) {
            return redirect()->route('home')->with('error', 'Please select a membership tier.');
        }
    
        
        $membershipTier = MembershipTier::find($tierId);
    
       
        if (!$membershipTier) {
            return redirect()->route('home')->with('error', 'Invalid membership tier selected.');
        }
    
       
        return view('membership.membershippurchase', compact('membershipTier'));
    }
    




public function purchaseProcess(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $tierId = $request->input('tier_id');

    
    $membershipTier = MembershipTier::find($tierId);

    if (!$membershipTier) {
        return redirect()->back()->with('error', 
        
        'Membership tier not found.');
    }

    
    $startDate = Carbon::now();
    $endDate = $startDate->copy()->addDays((int)$membershipTier->period);

    
    User::where('_id', Auth::id())->update([
        'membership' => [
            'tier_id' =>  $membershipTier->_id,
            'start_date' => $startDate->toISOString(),
            'end_date' => $endDate->toISOString(),    
            'status' => 'Active',
        ],
    ]);


     // Fetch the updated user and send email
      // Fetch the updated user
      $user = Auth::user();

      // Send membership confirmation email
      Mail::to($user->email)->send(new MembershipConfirmation($user, $membershipTier, $startDate, $endDate));
  
    return redirect()->route('membership')->with('success', 'Membership purchased successfully!');
}








}
