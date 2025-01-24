<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product; // Assuming Product is your product model

class CartLive extends Component
{
    public $products = [];
    public $total = 0;
    public $message = null;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            $this->message = 'Your cart is empty.';
            return;
        }

        if (empty($cart->items)) {
            $this->message = 'Your cart is empty.';
            return;
        }

        $this->products = $cart->items;
        $this->calculateTotal();
    }

    public function addToCart($productId)
    {
        $userId = Auth::id();
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Ensure `items` is an array
        $items = $cart->items ?? [];

        // Fetch the product details from the database (assumes you have a Product model)
        $product = Product::find($productId);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        $found = false;
        foreach ($items as &$item) {
            if ($item['product_id'] === $productId) {
                if ($item['quantity'] < $product->stock) {
                    $item['quantity'] += 1;
                    $item['price'] = $item['quantity'] * ($item['price'] / ($item['quantity'] - 1)); // Adjust price
                    $found = true;
                } else {
                    session()->flash('error', 'Not enough stock for this product.');
                    return;
                }
                break;
            }
        }

        if (!$found) {
            if ($product->stock > 0) {
                $items[] = [
                    'product_id' => $productId,
                    'product_name' => $product->name, // Assuming 'name' is the product name column
                    'quantity' => 1,
                    'price' => $product->price, // Assuming 'price' is the product price column
                ];
            } else {
                session()->flash('error', 'This product is out of stock.');
                return;
            }
        }

        $cart->items = $items; // Save updated items
        $cart->save();

        $this->loadCart(); // Refresh cart data
        session()->flash('success', 'Product added to cart!');
    }

    public function removeFromCart($productId)
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart || empty($cart->items)) {
            session()->flash('error', 'Cart is empty.');
            return;
        }

        $items = $cart->items;

        foreach ($items as $index => $item) {
            if ($item['product_id'] === $productId) {
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

        $cart->items = array_values($items); // Reindex array
        $cart->save();

        $this->loadCart(); // Refresh cart data
        session()->flash('success', 'Product removed from cart!');
    }

    public function calculateTotal()
    {
        $this->total = array_reduce($this->products, fn($carry, $item) => $carry + $item['price'], 0);
    }

    public function render()
    {
        return view('livewire.cart-live');
    }
}
