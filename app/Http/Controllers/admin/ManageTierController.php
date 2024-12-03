<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipTier;

class ManageTierController extends Controller
{
    public function managetier($id)//In vanilla php this would be inside the function like this : $id = $_GET['id'];
    {
       
        // $tierdetails =
        $tiers = MembershipTier::where( "id", $id)
        ->get();
        return view('admin.admin-sub-views.managetier', compact ('tiers'));
    }


    public function update(Request $request, $id)
    {
        $tier = MembershipTier::findOrFail($id);
        $tier->update($request->all());
        return redirect()->route('admin.membership.tiers');
    }

    public function destroy($id)
    {
        $tier = MembershipTier::findOrFail($id);
        $tier->delete();
        return redirect()->route('admin.membership.tiers');
    }   


    public function createview()
    {
        return view('admin.admin-sub-views.createtier');
    }


    public function addtier(Request $request)
{
    $tier = new MembershipTier();
    $tier->tier_name = $request->tier_name; // Matches the "name" attribute in the form
    $tier->description = $request->description;
    $tier->price = $request->price;
    $tier->period = $request->period;
    $tier->save();

    return redirect()->route('admin.membership.tiers')->with('success', 'Tier added successfully!');
}

    
    

//     public function edit($id)
// {
//     $tier = MembershipTier::findOrFail($id); // Fetch the tier by its ID
//     return view('admin.edit-tier', compact('tier')); // Pass the tier data to the view
// }

}
