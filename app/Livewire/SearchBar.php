<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class SearchBar extends Component
{
    public $query = ''; // User's search input
    public $products = []; // Search results

    public function searchProducts()
    {
        if ($this->query) {
            // Perform the search for case-insensitive matching
            $this->products = Product::where('product_name', 'regexp', '/' . $this->query . '/i')->get();
        } else {
            $this->products = [];
        }
    }

    public function clearSearch()
    {
        $this->query = ''; // Clear the query
        $this->products = []; // Clear the search results
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
