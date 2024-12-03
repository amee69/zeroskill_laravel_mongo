<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validate the input with MongoDB-specific uniqueness constraints
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Ensure email is unique
            'number' => ['required', 'string', 'max:15'], // Phone number validation
            'nic' => ['required', 'string', 'max:20', 'unique:users,nic'], // NIC must also be unique
            'address' => ['required', 'string', 'max:255'], // Address validation
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Create the user with a default 'role' set to 'normal'
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'number' => $input['number'],   // Save phone number
            'nic' => $input['nic'],         // Save NIC
            'address' => $input['address'], // Save address
            'role' => 'normal',             // Set default role
            'password' => Hash::make($input['password']),
            'created_at' => now(),          // Add timestamps
            'updated_at' => now(),
        ]);
    }
}
