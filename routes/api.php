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
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

// use MongoDB\BSON\Regex;

// Route::middleware('auth:sanctum')->get('/products/search', function (Request $request) {
//     $query = $request->input('query');

//     if (!$query) {
//         return response()->json(['message' => 'Query parameter is required'], 400);
//     }

//     // Ensure correct MongoDB regex search for partial matches
//     $products = Product::where('product_name', 'regex', new Regex(".*$query.*", 'i'))->get();

//     return response()->json($products);
// });


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



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
    
    $products = Product::orderBy('created_at', 'desc')->paginate(10);

    
    return response()->json($products);
});


Route::get('/products/{id}', function ($id) {
    // Fetch the product by its ID
    $product = Product::find($id);

    
    return response()->json($product);
});





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
    

//Cart Related API

Route::middleware('auth:sanctum')->post('/cart/add', function (Request $request) {
    $request->validate([
        'user_id' => 'required|exists:users,id', // Validate the provided user ID
        'product_id' => 'required|exists:products,id',
    ]);

    $userId = $request->input('user_id'); // Get user ID from request
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1); // Default quantity to 1 if not provided

    // Find the product
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Check stock
    if ($quantity > $product->stock) {
        return response()->json(['message' => 'Requested quantity exceeds stock'], 400);
    }

    // Retrieve or create the cart for the user
    $cart = Cart::firstOrCreate(['user_id' => $userId]);

    $items = $cart->items ?? [];
    $found = false;

    // Update existing item in the cart
    foreach ($items as &$item) {
        if ($item['product_id'] === $productId) {
            $item['quantity'] += $quantity;
            $item['price'] = $item['quantity'] * $product->price;
            $found = true;
            break;
        }
    }

    // Add new item if not found
    if (!$found) {
        $items[] = [
            'product_id' => $productId,
            'product_name' => $product->product_name,
            'quantity' => $quantity,
            'price' => $product->price * $quantity,
        ];
    }

    // Save updated items to the cart
    $cart->items = $items;
    $cart->save();

    return response()->json([
        'message' => 'Product added to cart successfully',
        'cart' => $cart,
    ]);
});


//remove product from cart api

//delete
Route::middleware('auth:sanctum')->post('/cart/remove', function (Request $request) {
    $request->validate([
        'user_id' => 'required|exists:users,id', // Validate the provided user ID (can use the toekn to see who the user id is too)
        'product_id' => 'required|exists:products,id',
    ]);

    $userId = $request->input('user_id'); // Get user ID from request
    $productId = $request->input('product_id');

    // Retrieve the cart for the user
    $cart = Cart::where('user_id', $userId)->first();

    if (!$cart || empty($cart->items)) {
        return response()->json(['message' => 'item not in cart'], 404);
    }

    $items = $cart->items;
    $itemFound = false;

    // Update or remove the item from the cart
    // foreach ($items as $index => &$item) {
    //     if ($item['product_id'] === $productId) {
    //         $itemFound = true;
    //         if ($item['quantity'] > 1) {
    //             // Reduce the quantity by one
    //             $item['quantity'] -= 1;
    //             $item['price'] = $item['quantity'] * $item['price'] / ($item['quantity'] + 1); // Adjust price
    //         } else {
    //             // Remove the item entirely if quantity is 1
    //             unset($items[$index]);
    //         }
    //         break;
    //     }
    // }

    foreach ($items as $index => $item) {
        if ($item['product_id'] === $productId) {
            $itemFound = true;
            if ($item['quantity'] > 1) {
                // Reduce the quantity by one
                $items[$index]['quantity'] -= 1;
                $items[$index]['price'] = $items[$index]['quantity'] * $item['price'] / ($items[$index]['quantity'] + 1); // Adjust price
            } else {
                // Remove the item entirely if quantity is 1
                unset($items[$index]);
            }
            break;
        }
    }

    if (!$itemFound) {
        return response()->json(['message' => 'product not found in cart'], 404);
    }

    // Update the cart
    $cart->items = array_values($items); // Reindex the array
    $cart->save();

    return response()->json([
        'message' => 'product removed from cart successfully',
        'cart' => $cart,
    ]);
});







//purchase product related api

// Route::middleware('auth:sanctum')->post('/process-order', function (Request $request) {
//     // Validate the request
//     $validatedData = $request->validate([
//         'user_id' => 'required|string',
//         'full_name' => 'required|string|max:255',
//         'city' => 'required|string|max:255',
//         'address' => 'required|string|max:255',
//         'house_number' => 'required|string|max:255',
//         'phone_number' => 'required|string|max:15',
//         'items' => 'required|array',
//         'items.*.product_id' => 'required|string',
//         'items.*.product_name' => 'required|string',
//         'items.*.quantity' => 'required|integer|min:1',
//         'items.*.price' => 'required|numeric|min:0',
//     ]);

//     // Calculate the total amount
//     $totalAmount = array_reduce($request->input('items'), function ($sum, $item) {
//         return $sum + ($item['price'] * $item['quantity']);
//     }, 0);

//     // Prepare the order data
//     $orderData = [
//         'user_id' => $request->input('user_id'),
//         'total_amount' => $totalAmount,
//         'status' => 'processing',
//         'order_date' => now(),
//         'shipping_details' => [
//             'full_name' => $request->input('full_name'),
//             'city' => $request->input('city'),
//             'address' => $request->input('address'),
//             'house_number' => $request->input('house_number'),
//             'phone_number' => $request->input('phone_number'),
//         ],
//         'payment_method' => 'card_payment',
//         'items' => $request->input('items'),
//         'created_at' => now(),
//         'updated_at' => now(),
//     ];

//     // Save the order into the orders collection
//     Order::create($orderData);

//     return response()->json(['success' => 'Your order has been placed successfully!'], 200);
// });




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
    // $totalAmount = array_reduce($request->input('items'), function ($sum, $item) {
    //     return $sum + ($item['price'] * $item['quantity']);
    // }, 0);

    $totalAmount = 0;

    foreach ($request->input('items') as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }


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

    // Deduct stock for each product in the order
    foreach ($request->input('items') as $item) {
        $product = Product::find($item['product_id']); // Fetch the product from the database
        
        if ($product) {
            // Deduct stock
            $product->stock = max(0, $product->stock - $item['quantity']); // Ensure stock does not go below 0
            $product->save(); // Save the updated product back to the database
        }
    }

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




// Route::middleware('auth:sanctum')->post('/orders', function (Request $request) {
//     try {
//         $user = $request->user();

//         if (!$user) {
//             return response()->json(['error' => 'User not authenticated.'], 401);
//         }

//         $request->validate([
//             'per_page' => 'sometimes|integer|min:1|max:100',
//             'page' => 'sometimes|integer|min:1',
//         ]); //if not provided, default to 10 per page and page 1 \ Below

//         $perPage = $request->input('per_page', 10); // Default to 10 per page
//         $page = $request->input('page', 1); // Default to page 1

//         $orders = App\Models\Order::where('user_id', $user->id)
//             ->orderBy('order_date', 'desc')
//             ->paginate($perPage, ['*'], 'page', $page);

//         return response()->json([
//             'success' => true,
//             'orders' => $orders->items(),
//             'current_page' => $orders->currentPage(),
//             'total_pages' => $orders->lastPage(),
//             'total_orders' => $orders->total(),
//         ], 200);

//     } catch (Exception $e) {
//         Log::error($e->getMessage());
//         return response()->json(['error' => 'An unexpected error occurred.'], 500);
//     }
// });



Route::middleware('auth:sanctum')->post('/orders', function (Request $request) {
    try {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        $orders = Order::where('user_id', $user->id)
            ->orderBy('order_date', 'desc')
            ->get(); // Fetch all orders without pagination

        return response()->json([
            'success' => true,
            'orders' => $orders,
        ], 200);

    } catch (Exception $e) {
        Log::error('Order fetch error: ' . $e->getMessage());

        return response()->json(['error' => 'Something went wrong.'], 500);
    }
});




Route::middleware('auth:sanctum')->post('/update-number', function (Request $request) {
    try {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'number' => 'required|string|min:10|max:15',
        ]);

        $user->number = $request->input('number');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Phone number updated successfully!',
        ], 200);
    } catch (Exception $e) {
        Log::error('Update number error: ' . $e->getMessage());

        return response()->json(['error' => 'error'], 500);
    }
});



// Route::get('/products-search', function (Request $request) {
//     $query = $request->input('query');  

//     // Check if query is provided
//     if (!$query) {
//         return response()->json(['message' => 'Query parameter is required'], 400);
//     }

//     try {
//         // Perform the text search using the text operator directly
//         $products = Product::where('$text', ['$search' => $query])->get();

//         // Check if products are found
//         if ($products->isEmpty()) {
//             return response()->json(['message' => 'No products found'], 404);
//         }

//         return response()->json($products);
//     } catch (\Exception $e) {
//         return response()->json(['message' => 'Error occurred during search'], 500);
//     }
// })->middleware( ['throttle:api']);




Route::get('/products-search', function (Request $request) {
    $query = $request->input('query');  

    // Check if query is provided
    if (!$query) {
        return response()->json(['message' => 'Query parameter is required'], 400);
    }

    try {
        // Perform the text search using the text operator directly
        $products = Product::where('$text', ['$search' => $query])->get();

        // Check if products are found
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json($products);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error occurred during search'], 500);
    }
})->middleware('throttle:api');
