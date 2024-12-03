<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddToCart extends Component
{
    public $productId;
    public $productName;
    public $price;
    public $quantity = 0; // Default quantity
    public $stock; // Product stock

    public function mount($productId, $productName, $price)
    {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->price = $price;

        $product = Product::find($productId); // Fetch product details
        $this->stock = $product->stock;

        if (Auth::check()) {
            $userId = Auth::id();
            $cart = Cart::where('user_id', $userId)->first();

            if ($cart && !empty($cart->items)) {
                foreach ($cart->items as $item) {
                    if ($item['product_id'] === $this->productId) {
                        $this->quantity = $item['quantity'];
                        break;
                    }
                }
            }
        }
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please log in to add items to the cart.');
            return;
        }

        if ($this->quantity >= $this->stock) {
            session()->flash('error', 'Product stock limit reached.');
            return;
        }

        $userId = Auth::id();
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Ensure `items` is an array
        $items = $cart->items ?? [];

        $found = false;
        foreach ($items as &$item) {
            if ($item['product_id'] === $this->productId) {
                $item['quantity'] += 1;
                $item['price'] = $item['quantity'] * $this->price;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $items[] = [
                'product_id' => $this->productId,
                'product_name' => $this->productName,
                'quantity' => 1,
                'price' => $this->price,
            ];
        }

        $cart->items = $items; // Directly assign the array
        $cart->save();

        $this->quantity += 1;

        session()->flash('success', "{$this->productName} added to cart!");
        
    }

    public function removeFromCart()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please log in to remove items from the cart.');
            return;
        }

        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart || empty($cart->items)) {
            session()->flash('error', 'Cart is empty.');
            return;
        }

        $items = $cart->items;
        foreach ($items as $index => &$item) {
            if ($item['product_id'] === $this->productId) {
                if ($item['quantity'] > 1) {
                    $item['quantity'] -= 1;
                    $item['price'] = $item['quantity'] * $this->price;
                } else {
                    unset($items[$index]); // Remove item if quantity reaches 0
                }
                break;
            }
        }

        $cart->items = array_values($items); // Reindex array
        $cart->save();

        $this->quantity = max(0, $this->quantity - 1);

        session()->flash('success', "{$this->productName} removed from cart!");
        

    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
