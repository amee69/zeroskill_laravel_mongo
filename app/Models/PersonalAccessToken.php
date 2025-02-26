<?php

// namespace App\Models;

// use MongoDB\Laravel\Eloquent\Model as MongoModel; // Use MongoDB's Eloquent model
// use Laravel\Sanctum\Contracts\HasAbilities;
// use Illuminate\Support\Facades\Log;

// class PersonalAccessToken extends MongoModel implements HasAbilities
// {
//     // Specify that this model is using the MongoDB connection
//     protected $connection = 'mongodb';  // Use the MongoDB connection
    
//     // Define the MongoDB collection
//     protected $collection = 'personal_access_tokens';  // MongoDB collection name

//     // Fields that can be mass-assigned
//     protected $fillable = [
//         'name',
//         'token',
//         'abilities',
//         'expires_at',
//         'tokenable_id',
//         'tokenable_type',
//     ];

//     // Hide the token field from JSON responses
//     protected $hidden = ['token'];

//     // Cast attributes to proper data types
//     protected $casts = [
//         'abilities' => 'array',    // Abilities field should be cast as an array
//         'last_used_at' => 'datetime',  // last_used_at field as a datetime
//         'expires_at' => 'datetime',   // expires_at field as a datetime
//     ];

//     // Define a polymorphic relationship (one-to-many polymorphic relation)
//     public function tokenable()
//     {
//         return $this->morphTo('tokenable');
//     }

//     // Find a token based on the token string
//     public static function findToken($token)
// {
//     Log::info('findToken invoked', ['token' => $token]);

//     if (strpos($token, '|') === false) {
//         Log::info('Using hashed token lookup');
//         return static::where('token', hash('sha256', $token))->first();
//     }

//     [$id, $plainToken] = explode('|', $token, 2);

//     Log::info('Attempting to find token by ID', ['id' => $id]);

//     try {
//         $instance = static::find($id);
//     } catch (\Exception $e) {
//         Log::error('Error finding token by ID', ['error' => $e->getMessage()]);
//         return null;
//     }

//     if (!$instance) {
//         Log::info('Token instance not found');
//         return null;
//     }

//     $isValid = hash_equals($instance->token, hash('sha256', $plainToken));
//     Log::info('Token validation result', ['isValid' => $isValid]);

//     return $isValid ? $instance : null;
// }

    


//     // Check if the token has a specific ability
//     public function can($ability)
//     {
//         return in_array('*', $this->abilities) || in_array($ability, $this->abilities);
//     }

//     // Check if the token is missing a specific ability
//     public function cant($ability)
//     {
//         return !$this->can($ability);
//     }
// }



namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as MongoModel;
use Laravel\Sanctum\Contracts\HasAbilities;

class PersonalAccessToken extends MongoModel implements HasAbilities
{
    /**
     * Specify the MongoDB connection and collection.
     */
    protected $connection = 'mongodb'; // Specify MongoDB connection
    protected $collection = 'personal_access_tokens'; // Specify MongoDB collection name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'expires_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'abilities' => 'array', // Cast abilities as an array
        'expires_at' => 'datetime', // Cast expires_at as a datetime object
        'last_used_at' => 'datetime', // Cast last_used_at as a datetime object
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'token',
    ];

    /**
     * Get the tokenable model that the access token belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function tokenable()
    {
        return $this->morphTo('tokenable');
    }

    /**
     * Find the token instance matching the given token.
     *
     * @param  string  $token
     * @return static|null
     */
    public static function findToken($token)
    {
        if (strpos($token, '|') === false) {
            return static::where('token', hash('sha256', $token))->first();
        }

        [$id, $token] = explode('|', $token, 2);

        if ($instance = static::find($id)) {
            return hash_equals($instance->token, hash('sha256', $token)) ? $instance : null;
        }

        return null;
    }

    /**
     * Determine if the token has a given ability.
     *
     * @param  string  $ability
     * @return bool
     */
    public function can($ability)
    {
        return in_array('*', $this->abilities) ||
               array_key_exists($ability, array_flip($this->abilities));
    }

    /**
     * Determine if the token is missing a given ability.
     *
     * @param  string  $ability
     * @return bool
     */
    public function cant($ability)
    {
        return !$this->can($ability);
    }
}
