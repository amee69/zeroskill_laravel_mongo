<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;

class ManageProducts extends Component
{
    use WithFileUploads;

   
    public $product_name;
    public $description;
    public $price;
    public $stock;
    public $category_id = null;
    public $images = [];

    public function render()
    {
        // etch categories to display in the dropdown
        $categories = Category::all();
        return view('livewire.manage-products', compact('categories'));
    }

    public function addProduct()
    {
        
        $this->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:800',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,_id',
            'images.*' => 'image|max:2048', 
        ]);

        // Process uploaded images and save their paths
        $imagePaths = [];
        foreach ($this->images as $image) {
            $fileName = $image->store('images/products', 'public'); // Save in 'storage/app/public/images/products'
            $imagePaths[] = 'storage/' . $fileName; // Add path to the array so it can be saved in the databade
        }

        $stock = (int) $this->stock;

        // Create the product and embed the images directly
        Product::create([
            'product_name' => $this->product_name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $stock,
            'category_id' => $this->category_id,
            'images' => $imagePaths, 
        ]);

       
        $this->reset(['product_name', 'description', 'price', 'stock', 'category_id', 'images']);

        
        session()->flash('success', 'Product added successfully!');
    }
}
