<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\MembershipTier;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//api stuff below

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

    // Return the membership tier as a JSON response
    return response()->json($membership);
});
    