<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MembershipTier;
use Carbon\Carbon;

class AdminController extends Controller
{
    
    public function index()
    {
        return view('admin.admin');
    }

    
    public function members()
    {
       
        $members = User::where('role', 'normal')
            ->whereNotNull('membership')
            ->paginate(6);

            // dd($members);
//creating an array with membership names and their index with the user id
        
        $membershipTiers = [];

        foreach ($members as $member) {
           
            $tierId = $member->membership['tier_id'] ?? null;

            if ($tierId) {
                
                $tier = MembershipTier::find($tierId);
                $membershipTiers[$member->id] = $tier ? $tier->tier_name : 'N/A';
            } else {
                $membershipTiers[$member->id] = 'N/A';
            }
        }
        // dd($members);

       
        return view('admin.admin-sub-views.members', compact('members', 'membershipTiers'));
    }

    public function updateMemberMembership($id)
    {
        
        $user = User::findOrFail($id);



        
        $membershiptiers = MembershipTier::all();
        $currentTier = MembershipTier::find($user->membership['tier_id'] ?? null);

        
        return view('admin.admin-sub-views.update-member-membership', compact('user', 'membershiptiers', 'currentTier'));
    }



   
    public function membershiptiers()
    {
        $membershiptiers = MembershipTier::all(); 
        return view('admin.admin-sub-views.membershiptiers', compact('membershiptiers'));
    }


    

    public function updateMemberMembershipProcess(Request $request, $id)
    {
       
        $tierId = $request->input('membership_tier');
    
    
        $user = User::findOrFail($id);
    
        
        $tier = MembershipTier::findOrFail($tierId);
    
       
        $startDate = Carbon::now();
    
       
        $endDate = $startDate->copy()->addDays((int)$tier->period);
    
       
        $user->membership = [
            'tier_id' => $tier->id,
            'start_date' => $startDate->toISOString(),
            'end_date' => $endDate->toISOString(),
            'status' => 'Active',
        ];
    
     
        $user->save();
    
        
        return redirect()->back()->with('success', 'Membership updated successfully!');
    }

    public function cancelMemberMembership($id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Set the membership to null
    $user->membership = null;

    // Save the changes
    $user->save();

    // Redirect to the members view with a success message
    return redirect()->route('admin.members')->with('success', 'Membership cancelled successfully!');
}

    





    
    public function registeredusers()
    {
        
        $allusers = User::where('role', 'normal') 
            ->paginate(10); 

        return view('admin.admin-sub-views.registered-users', compact('allusers'));
    }








    public function editRegisteredUser($id)
    {
       
        $user = User::findOrFail($id);

        
        return view('admin.admin-sub-views.edit-registered-user', compact('user'));
    }

    public function update(Request $request, $id)
{
    
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'number' => 'nullable|string|max:15',
        'nic' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
    ]);

    
    $user = User::findOrFail($id);
    $user->update($validatedData);

   
    return redirect()->back()->with('success', 'User details updated successfully!');
}



public function deleteRegisteredUser($id)
{

    $user = User::findOrFail($id);

    
    $user->delete();

    return redirect()->back()->with('success', 'User deleted successfully!');



}







}
