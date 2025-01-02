<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
// use Laravel\Sanctum\PersonalAccessToken;

use App\Models\PersonalAccessToken;


use App\Models\ApiUser;
use App\Models\User;

class ApiAuthController extends Controller
{
    public function register(Request $request)
{
    // Validate the input fields
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:user,email',
        'password' => 'required|string|min:8|confirmed',
        'number' => 'required|string|max:15',
        'nic' => 'required|string|max:20|unique:user,nic',
        'address' => 'required|string|max:500',
    ]);

    try {
      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'number' => $request->number,
            'nic' => $request->nic,
            'address' => $request->address,
            'role' => 'normal', // Assign default role as 'normal'
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Registration failed',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    

    

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        try {
            // Retrieve the user
            $user = User::where('email', trim($request->email))->first();
            
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            // Log the user details for debugging
            Log::info("User found: " . $user->email);
    
            // Check if password matches
            if (Hash::check($request->password, $user->password)) {
                // Generate a token
                $token = bin2hex(random_bytes(40)); // Generate a random token string
    
                // Log token creation attempt
                Log::info("Token generated for user: " . $user->email);
    
                // Create a new token record and associate it with the user
                $user->tokens()->create([
                    'tokenable_id' => $user->_id,
                    'tokenable_type' => get_class($user),
                    'name' => 'api-token',
                    'token' => hash('sha256', $token),
                    'abilities' => ['*']
                ]);
    
                Log::info("Token saved for user: " . $user->email);
    
                return response()->json([
                    'message' => 'Login successful',
                    'token' => $token,
                    'user' => $user,
                ]);
            }
    
            return response()->json(['message' => 'Invalid credentials'], 401);
    
        } catch (\Exception $e) {
            // Log the error
            Log::error("Login failed for email " . $request->email . ": " . $e->getMessage());
    
            // Return a generic error response
            return response()->json([
                'message' => 'An error occurred during login. Please try again later.',
            ], 500);
        }
    }
    


    public function logout(Request $request)
{
    // Revoke the token that was used to authenticate the current request
    $request->user()->tokens()->delete();

    return response()->json([
        'message' => 'Logout successful'
    ]);
}



    
    

    

    
    
    

}
