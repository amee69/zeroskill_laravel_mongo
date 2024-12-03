<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class ShopLayout extends Component
{
    public function render()
    {
        // Fetch categories directly in the render method and pass them to the view
        $categories = Category::all();
        return view('layouts.shop-layout', compact('categories'));
    }
}
