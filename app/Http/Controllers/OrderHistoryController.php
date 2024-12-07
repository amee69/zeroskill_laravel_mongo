<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        
        $orders = Order::where('user_id', $userId)
            ->orderBy('order_date', 'desc')
            ->paginate(5);

        return view('shop.order-history', compact('orders'));
    }
}
