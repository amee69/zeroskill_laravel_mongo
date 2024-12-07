<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PurchaseMembershipController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ManageTierController;
use App\Http\Controllers\admin\ManageProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Middleware\CheckUserRole;

// Public Routes (Accessible without authentication)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view('/contact', 'contact')->name('contact');

// Shop Routes (Accessible to all users)
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/products/{product}', [ShopController::class, 'singleProductView'])->name('single.product.view');

// Dynamic category route for shop
Route::get('/shop/category/{category}', [ShopController::class, 'showCategory'])->name('shop.category');

// Membership Routes (Accessible to all users)
Route::get('/membership', [MembershipController::class, 'index'])->name('membership');

// Authenticated Routes (Accessible only to logged-in users)
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Cart and Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('view.cart');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/order/confirmation', function () {
        return view('shop.order-confirmation');
    })->name('order.confirmation');

    // Order History
    Route::get('/orders', [OrderHistoryController::class, 'index'])->name('orders.history');

    // Membership Purchase
    Route::get('/membership/purchase', [PurchaseMembershipController::class, 'index'])->name('membership.purchase');
    Route::post('/membership/purchase', [PurchaseMembershipController::class, 'purchaseProcess'])->name('membership.purchase.process');
});

// Admin Routes (Accessible only to admins)
Route::middleware(['auth', CheckUserRole::class . ':admin'])->group(function () {
    Route::get('/controls', [AdminController::class, 'index'])->name('controls');

    // Admin Member Management
    Route::get('/controls/members', [AdminController::class, 'members'])->name('admin.members');
    Route::get('/controls/membership/edit/{id}', [AdminController::class, 'updateMemberMembership'])->name('update.member.membership');
    Route::patch('/admin/members/{id}/update-process', [AdminController::class, 'updateMemberMembershipProcess'])->name('admin.update.member.membership');

    Route::delete('/admin/members/{id}/cancel-membership', [AdminController::class, 'cancelMemberMembership'])->name('admin.cancel.member.membership');



    Route::get('/controls/registered-users', action: [AdminController::class, 'registeredusers'])->name('admin.registered.users');

    // Membership Tier Management
    Route::get('/controls/membership-tiers', [AdminController::class, 'membershiptiers'])->name('admin.membership.tiers');
    Route::get('/membership-tiers-manage/{id}', [ManageTierController::class, 'managetier'])->name('managetier');
    Route::get('/membership-tiers-manage/{id}/updating', [ManageTierController::class, 'update'])->name('managetier.update');
    Route::get('/membership-tiers-manage/{id}/delete', [ManageTierController::class, 'destroy'])->name('managetier.delete');
    Route::get('/membership-tiers/manage/create/page', [ManageTierController::class, 'createview'])->name('addtier');
    Route::post('/membership-tiers/add', [ManageTierController::class, 'addtier'])->name('addtierprocessing');

    // Shop Management
    Route::get('/controls/shop/manage/category', [ManageProductsController::class, 'manageCategory'])->name('admin.shop');
    Route::get('/controls/shop/manage/products', [ManageProductsController::class, 'manageProducts'])->name('admin.manage.products');
    Route::get('/controls/shop/manage/products/edit-product/{id}', [ManageProductsController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/controls/shop/manage/products/process/{id}', [ManageProductsController::class, 'updateProduct'])->name('admin.product.update');
    Route::delete('/controls/shop/manage/products/{id}', [ManageProductsController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::get('/controls/shop/manage/orders', [ManageProductsController::class, 'manageOrders'])->name('admin.manage.orders');
    Route::get('/controls/shop/manage/order-history', [ManageProductsController::class, 'manageOrderHistory'])->name('admin.manage.history');

    Route::get('/controls/shop/manage/order/{id}/edit', [ManageProductsController::class, 'manageSingleOrder'])->name('admin.manage.singleorder');
    Route::get('/controls/shop/manage/order/{order}/complete', [ManageProductsController::class, 'markAsCompleted'])->name('admin.order.complete');

    Route::patch('/controls/shop/manage/order/cancel/{id}', [ManageProductsController::class, 'cancelOrderView'])->name('admin.order.cancel');
    Route::patch('/controls/shop/manage/order/cancel/process/{id}', [ManageProductsController::class, 'cancelOrder'])->name('admin.order.cancel.process');


    Route::get('/controls/shop/manage/products/{id}/history', [ManageProductsController::class, 'singleOrderHistory'])->name('admin.manage.singleorder.history');
    


    



    
    // Categories Management
    Route::get('/categories/{id}/edit-Category', [ManageProductsController::class, 'editCat'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [ManageProductsController::class, 'updateCat'])->name('admin.categories.update');
    Route::post('/admin/categories', [ManageProductsController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', [ManageProductsController::class, 'deleteCat'])->name('admin.categories.delete');

    // User Management
    Route::get('/users/{id}/edit', [AdminController::class, 'editRegisteredUser'])->name('users.edit');
    Route::patch('/admin/users/{id}/update', [AdminController::class, 'update'])->name('admin.user.update');

    Route::delete('/users/{id}', [AdminController::class, 'deleteRegisteredUser'])->name('users.destroy');
});

// Welcome Route for Authenticated Users
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});
