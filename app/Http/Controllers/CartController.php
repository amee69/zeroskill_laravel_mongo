<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // public function index()
    // {
    //     $userId = Auth::id();

    //     // Fetch the cart for the current user
    //     $cart = Cart::where('user_id', $userId)->first();

    //     // If no cart exists, show a message
    //     // if (!$cart) {
    //     //     return view('shop.cart', ['products' => [], 'cartItems' => [], 'message' => 'No cart found for this user.']);
    //     // }

    //     // Check if the items array is empty and if cart is not yet made
    //     $items = $cart->items ?? [];
    //     if (empty($items) || !$cart) {
    //         return view('shop.cart', ['products' => [], 'cartItems' => [], 'message' => 'Your cart is empty.']);
    //     }

    //     // Map the items array to products
    //     $products = [];
    //     foreach ($items as $item) {
    //         $products[] = [
    //         'product_id' => $item['product_id'],
    //         'product_name' => $item['product_name'],
    //         'quantity' => $item['quantity'],
    //         'price' => $item['price'],
    //         ];
    //     }

    //     // Pass the cart items and products to the view
    //     return view('shop.cart', ['products' => $products, 'cartItems' => $items, 'message' => null]);
    // }


    public function index()
{
    $userId = Auth::id();

    // Fetch the cart for the current user
    $cart = Cart::where('user_id', $userId)->first();

    // Check if the cart exists and contains items
    $items = $cart->items ?? [];
    if (empty($items) || !$cart) {
        return view('shop.cart', ['products' => [], 'cartItems' => []]);
    }

    // Map the items array to products and check stock
    $products = [];

    foreach ($items as $item) {
        $product = Product::find($item['product_id']);

        if (!$product || $product->stock < $item['quantity']) {
            // Skip adding out of stock products
            continue;
        }

        $products[] = [
            'product_id' => $item['product_id'],
            'product_name' => $item['product_name'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'stock' => $product->stock,
        ];
    }

    // Update the cart to remove out of stock items
    $cart->items = $products;
    $cart->save();

    return view('shop.cart', [
        'products' => $products,
        'cartItems' => $items,
    ]);
}

}
