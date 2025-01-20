<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartAddAll extends Component
{
    public $productId;
    public $productName;
    public $price;
    public $quantity = 0; // Default quantity
    public $stock; // Product stock

    public function mount($productId, $productName, $price, $stock)
    {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->price = $price;
        $this->stock = $stock;

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
            session()->flash('error', 'Log in');
            return;
        }

        if ($this->quantity >= $this->stock) {
            session()->flash('error', '!');
            return;
        }

        $userId = Auth::id();
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

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

        $cart->items = $items;
        $cart->save();

        $this->quantity += 1;

        session()->flash('success', "✔");
    }

    public function removeFromCart()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Log in');
            return;
        }

        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart || empty($cart->items)) {
            session()->flash('error', 'Cart is empty.');
            return;
        }

        $items = $cart->items;
        
        // foreach ($items as $index => &$item) {
        //     if ($item['product_id'] === $this->productId) {
        //         if ($item['quantity'] > 1) {
        //             $item['quantity'] -= 1;
        //             $item['price'] = $item['quantity'] * $this->price;
        //         } else {
        //             unset($items[$index]);
        //         }
        //         break;
        //     }
        // }

        foreach ($items as $index => $item) {
            if ($item['product_id'] === $this->productId) {
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

        $cart->items = array_values($items);
        $cart->save();

        $this->quantity = max(0, $this->quantity - 1);

        
    }

    public function render()
    {
        return view('livewire.cart-add-all');
    }
}
