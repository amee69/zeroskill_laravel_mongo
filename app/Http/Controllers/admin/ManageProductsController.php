<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;

class ManageProductsController extends Controller
{
    /**
     * Display the products with pagination.
     */
    // public function index()
    // {
    //     // Fetch products with pagination (10 per page)
    //     $products = Product::paginate(10);

    //     // Pass products data to the view
    //     return view('admin.admin-sub-views.shop', compact('products'));
    // }

//     public function index()
// {
//     $products = Product::with('category')->paginate(10); // Fetch products with categories
//     return view('admin.admin-sub-views.manage-category', compact('products'));
// }


// public function index()
//     {
//         return view('admin.admin-sub-views.manage-category');
//     }

// public function showCategory($category)
// {
//     // Find the category by name or fail if not found
//     $categoryModel = Category::where('category_name', $category)->firstOrFail();

//     // Fetch products for the selected category
//     $products = Product::where('category_id', $categoryModel->id)->paginate(10);

//     // Fetch all categories for the sidebar or navigation
//     $categories = Category::all();

//     // Pass the current category and products to the view
//     return view('shop.shop', compact('categories', 'products', 'categoryModel'));
// }


//===============================================================MANAGE CATEGORY SECTIONS===================================================
public function manageCategory()
{
   
    $categories = Category::paginate(10);

   
    return view('admin.admin-sub-views.manage-category', compact('categories'));
}


public function storeCategory(Request $request)
{
   
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
    ]);

    
    Category::create([
        'category_name' => $request->name,
        'description' => $request->description,
    ]);

    
    return redirect()->back()->with('success', 'Category added successfully!');
}

public function deleteCat(Category $category)
    {
        
        $category->delete();

     
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }


    public function editCat($id)
{
    $category = Category::findOrFail($id);

    // Return a view to edit the category
    return view('admin.admin-sub-views.edit-category', compact('category'));
}


public function updateCat(Request $request, $id)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
        'description' => 'required|string|max:500',
    ]);

    $category = Category::findOrFail($id);
    $category->update([
        'category_name' => $request->input('category_name'),
        'description' => $request->input('description'),
    ]);

    return redirect()->route('admin.shop')->with('success', 'Category updated successfully!');

    //redirected the route ecause the route is default for the category view page (Admin)
}


//=======================================================MANAGE PRODUCTS SECTIONS================================================================
public function manageProducts()
{
    
    $products = Product::with('category')->orderBy('created_at','desc')->paginate(10);

    $categories = Category::all();

    
    return view('admin.admin-sub-views.manage-products', compact('products', 'categories'));
}


public function deleteProduct($id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Delete the product
    $product->delete();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Product deleted successfully!');
}


// public function categires()
// {
//     $categories = Category::all();
//     return view('admin.admin-sub-views.manage-products', compact('categories'));

// }


// ==============================================MANAGE ORDERS SECTIONNN++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

public function manageOrders()
{
    // Fetch all orders that are not completed, sorted by newest first, with pagination (10 per page)
    $orders = Order::where('status', '!=', 'completed')
        ->orderBy('created_at', 'desc') 
        ->paginate(10);

    return view('admin.admin-sub-views.manage-orders', compact('orders'));
}



public function manageSingleOrder($id)
{
    // Find the order by ID
    $order = Order::findOrFail($id);
    // dd($order);
    return view('admin.admin-sub-views.manage-single-order', compact('order'));


}
public function markAsCompleted($id)
{
    // Find the order by ID
    $order = Order::findOrFail($id);
    $order->status = 'completed';
    $order->save();

    // Redirect to the manage-orders view with a success message
    return redirect()->route('admin.manage.orders')->with('success', 'Order Marked as Completed & Moved To Order History!');
}






public function manageOrderHistory()
{
    // Fetch all orders with pagination (10 per page)
    $orders = Order::where('status', 'completed')->paginate(10);
    return view('admin.admin-sub-views.manage-order-history', compact('orders'));
}

public function singleOrderHistory($id)
{
    // Find the order by ID
    $order = Order::findOrFail($id);
    return view('admin.admin-sub-views.manage-single-order-history', compact('order'));




}






}   