<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\MembershipTier;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\admin\ManageProductsController;
use App\Models\Category;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Public routes
Route::post('/register', [ApiAuthController::class, 'register']); // API user registration
Route::post('/login', [ApiAuthController::class, 'login']);       // API user login

Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->post('/category', function (Request $request) {
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
    ]);

    // Create a new category (Ensure MongoDB field names match)
    Category::create([
        'category_name' => $request->name, // MongoDB expects 'category_name'
        'description' => $request->description,
    ]);

    // Return a JSON response indicating successp
    return response()->json([
        'message' => 'Category added successfully!',
    ], 201);
});


Route::middleware('auth:sanctum')->get('/protected', function () {
    return response()->json(['message' => 'You are authenticated!']);
});














/////////////////////////////////////////////////////////////////////////////

//api stuff below MAD

Route::get('/products', function (Request $request) {
    // Fetch all products with pagination (10 per page) and sort by creation date in descending order
    $products = Product::orderBy('created_at', 'desc')->paginate(10);

    // Return the products as a JSON response
    return response()->json($products);
});


Route::get('/products/{id}', function ($id) {
    // Fetch the product by its ID
    $product = Product::find($id);

    // Return the product as a JSON response
    return response()->json($product);
});


Route::get('/memberships', function (Request $request) {
    // Fetch all membership tiers
    $memberships = MembershipTier::all();

    // Return the membership tiers as a JSON response
    return response()->json($memberships);
});

Route::get('/memberships/{id}', function ($id) {
    // Fetch the membership tier by its ID
    $membership = MembershipTier::find($id);

    return response()->json($membership);
});
    






