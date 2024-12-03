<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the shop view with paginated products.
     */
    public function shop()
{
    $categories = Category::all(); // Fetch all categories

    // Fetch all products with pagination (10 per page) and sort by creation date in descending order
    $products = Product::orderBy('created_at', 'desc')->paginate(10);

    // Return the view with the fetched categories and products
    return view('shop.shop', compact('categories', 'products'));
}


    /**
     * Display products of a specific category.
     *
     * @param string $category
     * @return \Illuminate\View\View
     */
    public function showCategory($category)
    {
        // Find the category by name or fail if not found
        $categoryModel = Category::where('category_name', $category)->firstOrFail();

        // Fetch products for the selected category by category_id
        $products = Product::where('category_id', $categoryModel->_id)
        ->orderBy( 'created_at','desc')->paginate(10);

        // Fetch all categories for the sidebar or navigation
        $categories = Category::all();

        // Pass the current category and products to the view
        return view('shop.shop', compact('categories', 'products', 'categoryModel'));
    }

    // /**
    //  * Display a single product with its details.
    //  *
    //  * @param string $product_id
    //  * @return \Illuminate\View\View
    //  */
    public function singleProductView($product_id)
    {
        // Fetch the product by ID, including embedded images
        $product = Product::findOrFail($product_id);

        // Fetch all categories for the sidebar or navigation
        $categories = Category::all();

        // Pass the product and categories to the view
        return view('shop.single-product', compact('product', 'categories'));
    }
}
