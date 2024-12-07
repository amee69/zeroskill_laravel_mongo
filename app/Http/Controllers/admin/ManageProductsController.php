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



public function editProduct($id)
{
    // Find the product by ID or fail
    $product = Product::findOrFail($id);
    
    // Retrieve all categories for the dropdown list
    $categories = Category::all();

    // Pass both the product and categories to the view
    return view('admin.admin-sub-views.edit-product', compact('product', 'categories'));
}



public function updateProduct(Request $request, $id)
{
    // Find the product by ID or fail
    $product = Product::findOrFail($id);

    // Validate the form data
    $validatedData = $request->validate([
        'product_name' => 'required|string|max:255',
        'description' => 'nullable|string|max:800',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,_id',
        'images.*' => 'image|max:2048', // Validate each image
    ]);

    // Update product fields
    $product->product_name = $validatedData['product_name'];
    $product->description = $validatedData['description'];
    $product->price = $validatedData['price'];
    $product->stock = $validatedData['stock'];
    $product->category_id = $validatedData['category_id'];

    // Handle image uploads if new images are provided
    if ($request->hasFile('images')) {
        $imagePaths = [];

        foreach ($request->file('images') as $image) {
            $fileName = $image->store('images/products', 'public');
            $imagePaths[] = 'storage/' . $fileName;
        }

        // Replace the old images with the new ones
        $product->images = $imagePaths;
    }

    // Save the updated product
    $product->save();

    // Flash success message and redirect back to the edit page
    return redirect()->route('admin.products.edit', $product->_id)->with('success', 'Product updated successfully!');
}





// public function categires()
// {
//     $categories = Category::all();
//     return view('admin.admin-sub-views.manage-products', compact('categories'));

// }


// ==============================================MANAGE ORDERS SECTIONNN++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

public function manageOrders()
{
    // Fetch all orders with the status 'processing', sorted by newest first, with pagination (10 per page)
    $orders = Order::where('status', 'processing')
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
    // Fetch orders with the specified statuses and paginate (10 per page)
    $orders = Order::whereIn('status', ['completed', 'cancelled', 'Refunded_Cancelled'])->paginate(10);
    
    return view('admin.admin-sub-views.manage-order-history', compact('orders'));
}


public function singleOrderHistory($id)
{
    // Find the order by ID
    $order = Order::findOrFail($id);
    return view('admin.admin-sub-views.manage-single-order-history', compact('order'));




}


public function cancelOrderView($id){
    $order = Order::findOrFail($id);
    return view('admin.admin-sub-views.cancel-order', compact('order'));

    
}

public function cancelOrder(Request $request, $id)
{
    // Validate the cancellation reason
    $request->validate([
        'cancellation_reason' => 'required|string|max:800',
    ]);

    // Find the order by ID
    $order = Order::findOrFail($id);

    // Set status based on the payment method
    if ($order->payment_method === 'card_payment') {
        $order->status = 'Refunded_Cancelled';
    } else {
        $order->status = 'cancelled';
    }

    // Add the cancellation reason
    $order->cancellation_reason = $request->input('cancellation_reason');

    // Save the updated order
    $order->save();

    // Redirect back to the manage-orders view with a success message
    return redirect()->route('admin.manage.orders')->with('success', 'Order Cancelled Successfully!');
}







}   