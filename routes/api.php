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
use Illuminate\Support\Facades\Log;


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




Route::get('/membership-tier/{id}', function ($id) {
    try {
        // Find the membership tier by ID
        $tier = MembershipTier::find($id);

        if (!$tier) {
            return response()->json([
                'error' => 'Membership tier not found.'
            ], 404);
        }

        return response()->json([
            'tier_name' => $tier->tier_name
        ], 200);

    } catch (\Exception $e) {
        
        return response()->json([
            'error' => 'An error occurred: ' . $e->getMessage()
        ], 500);
    }
});


Route::middleware('auth:sanctum')->get('/cart/{user_id}', function ($user_id) {
    // Fetch the cart items for the user
    $cartItems = Cart::where('user_id', $user_id)->get();

    return response()->json($cartItems);
});



Route::middleware('auth:sanctum')->post('/purchase-membership', function (Request $request) {
    try {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $tierId = $request->input('tier_id');
        $membershipTier = App\Models\MembershipTier::find($tierId);

        if (!$membershipTier) {
            return response()->json(['error' => 'Membership tier not found.'], 404);
        }

        $startDate = now();
        $endDate = $startDate->copy()->addDays($membershipTier->period);

        $user->update([
            'membership' => [
                'tier_id' => $membershipTier->_id,
                'start_date' => $startDate->toISOString(),
                'end_date' => $endDate->toISOString(),
                'status' => 'Active',
            ],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Membership purchased successfully!',
            'membership' => $user->membership,
        ], 200);
    } catch (Exception $e) {
        return response()->json(['error' => 'An unexpected error occurred.'], 500);
    }
});




Route::middleware('auth:sanctum')->post('/orders', function (Request $request) {
    try {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        // Validate pagination inputs (optional)
        $request->validate([
            'per_page' => 'sometimes|integer|min:1|max:100',
            'page' => 'sometimes|integer|min:1',
        ]);

        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $page = $request->input('page', 1); // Default to page 1

        $orders = App\Models\Order::where('user_id', $user->id)
            ->orderBy('order_date', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'orders' => $orders->items(),
            'current_page' => $orders->currentPage(),
            'total_pages' => $orders->lastPage(),
            'total_orders' => $orders->total(),
        ], 200);

    } catch (Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['error' => 'An unexpected error occurred.'], 500);
    }
});



