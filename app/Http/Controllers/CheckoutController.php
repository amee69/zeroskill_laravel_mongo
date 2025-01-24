<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB; // For MongoDB connection
use App\Models\Order; // Import the Order model
use App\Models\Product; // Import the Product model

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $userId = Auth::id();

        // Fetch the cart for the current user
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart || empty($cart->items)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        return view('shop.checkout', ['cartItems' => $cart->items]);
    }

    /**
     * Process the checkout.
     */
//     public function process(Request $request)
// {
//     $userId = Auth::id();
//     $cart = Cart::where('user_id', $userId)->first();

//     if (!$cart || empty($cart->items)) {
//         return redirect()->route('cart')->with('error', 'Your cart is empty.');
//     }

//     // Use items directly from the cart
//     $orderData = [
//         'user_id' => $userId,
//         'total_amount' => array_sum(array_column($cart->items, 'price')),
//         'status' =>  'processing',
//         'order_date' => now(),
//         'shipping_details' => [
//             'full_name' => $request->full_name,
//             'city' => $request->city,
//             'address' => $request->address,
//             'house_number' => $request->house_number,
//             'phone_number' => $request->phone_number,
//         ],
//         'payment_method' => $request->payment_method,
//         'items' => $cart->items, // Directly use the cart's items
//         'created_at' => now(),
//         'updated_at' => now(),
//     ];

//     // Save order into the orders collection
//     Order::create($orderData);

//     // Clear the cart
//     $cart->items = [];
//     $cart->save();

//     return redirect()->route('order.confirmation')->with('success', 'Your order has been placed successfully!');
// }

public function process(Request $request)
{
    $userId = Auth::id();
    $cart = Cart::where('user_id', $userId)->first();

    if (!$cart || empty($cart->items)) {
        return redirect()->route('cart')->with('error', 'Your cart is empty.');
    }

    // Calculate the total amount
    $totalAmount = array_sum(array_column($cart->items, 'price'));

    $orderData = [
        'user_id' => $userId,
        'total_amount' => $totalAmount,
        'status' => 'processing',
        'order_date' => now(),
        'shipping_details' => [
            'full_name' => $request->full_name,
            'city' => $request->city,
            'address' => $request->address,
            'house_number' => $request->house_number,
            'phone_number' => $request->phone_number,
        ],
        'payment_method' => $request->payment_method,
        'items' => $cart->items,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    // Save order into the orders collection
    Order::create($orderData);

    // Deduct product quantities
    foreach ($cart->items as $item) {
        $product = Product::find($item['product_id']);
        if ($product) {
            if ($product->stock < $item['quantity']) {
                return redirect()->route('cart')->with('error', "Insufficient stock for product: {$product->product_name}.");
            }

            // Deduct the quantity
            $product->stock -= $item['quantity'];
            $product->save();
        }
    }

    // Clear the cart
    $cart->items = [];
    $cart->save();

    return redirect()->route('order.confirmation')->with('success', 'Your order has been placed successfully!');
}


    
}
