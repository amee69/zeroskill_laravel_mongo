<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\MembershipTier;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\admin\ManageProductsController;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Public routes
Route::post('/register', [ApiAuthController::class, 'register']); 
Route::post('/login', [ApiAuthController::class, 'login']);       

Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->post('/category', function (Request $request) {
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
    ]);

    Category::create([
        'category_name' => $request->name, 
        'description' => $request->description,
    ]);

    
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


// Route::get('/memberships', function (Request $request) {
//     // Fetch all membership tiers=
//     $memberships = MembershipTier::all();

//     // Return the membership tiers as a JSON response
//     return response()->json($memberships);
// });


Route::middleware('auth:sanctum')->get('/memberships', function (Request $request) {
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
    






//purchase product related api

Route::middleware('auth:sanctum')->post('/process-order', function (Request $request) {
    // Validate the request
    $validatedData = $request->validate([
        'user_id' => 'required|string',
        'full_name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'house_number' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'items' => 'required|array',
        'items.*.product_id' => 'required|string',
        'items.*.product_name' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.price' => 'required|numeric|min:0',
    ]);

    // Calculate the total amount
    $totalAmount = array_reduce($request->input('items'), function ($sum, $item) {
        return $sum + ($item['price'] * $item['quantity']);
    }, 0);

    // Prepare the order data
    $orderData = [
        'user_id' => $request->input('user_id'),
        'total_amount' => $totalAmount,
        'status' => 'processing',
        'order_date' => now(),
        'shipping_details' => [
            'full_name' => $request->input('full_name'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'house_number' => $request->input('house_number'),
            'phone_number' => $request->input('phone_number'),
        ],
        'payment_method' => 'card_payment',
        'items' => $request->input('items'),
        'created_at' => now(),
        'updated_at' => now(),
    ];

    // Save the order into the orders collection
    Order::create($orderData);

    return response()->json(['success' => 'Your order has been placed successfully!'], 200);
});