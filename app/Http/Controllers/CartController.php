<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Fetch the cart for the current user
        $cart = Cart::where('user_id', $userId)->first();

        // If no cart exists, show a message
        if (!$cart) {
            return view('shop.cart', ['products' => [], 'cartItems' => [], 'message' => 'No cart found for this user.']);
        }

        // Check if the items array is empty
        $items = $cart->items ?? [];
        if (empty($items)) {
            return view('shop.cart', ['products' => [], 'cartItems' => [], 'message' => 'Your cart is empty.']);
        }

        // Map the items array to products
        $products = collect($items)->map(function ($item) {
            return [
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];
        });

        // Pass the cart items and products to the view
        return view('shop.cart', ['products' => $products, 'cartItems' => $items, 'message' => null]);
    }
}
