<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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