<x-guest-layout>
    <div class="mx-auto flex flex-col items-center py-36 px-4 md:py-40 text-black">
        <div class="w-full max-w-6xl p-4 md:p-8 border rounded-lg shadow-lg bg-black">
            <h1 class="text-center font-bold text-3xl md:text-4xl tracking-wider text-white mb-6 md:mb-8">
                My Orders
            </h1>

            @if ($orders->isEmpty())
                <p class="text-center text-white text-lg">You have not placed any orders yet.</p>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div x-data="{ open: false }" class="border rounded-lg p-4 md:p-6 bg-gray-100">
                            <div class="flex flex-col md:flex-row md:justify-between items-start md:items-center">
                                <div class="w-full mb-4 md:mb-0">
                                    @if ($order->status === 'cancelled' || $order->status === 'Refunded_Cancelled')
                                        <h2 class="text-lg font-bold text-gray-800 line-through">
                                            Order ID: {{ $order->_id }}
                                        </h2>
                                    @else
                                        <h2 class="text-lg font-bold text-gray-800">
                                            Order ID: {{ $order->_id }}
                                        </h2>
                                    @endif

                                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

                                    @if (isset($order->cancellation_reason))
                                        <p><strong>Cancellation Reason:</strong> {{ $order->cancellation_reason }}</p>
                                    @endif
                                   
                                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                                    <p><strong>Order Date:</strong>
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y, h:i A') }}
                                    </p>
                                    <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
                                </div>

                                <button @click="open = !open"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-md transition w-full md:w-auto">
                                    <span x-show="!open">+</span>
                                    <span x-show="open">-</span>
                                </button>
                            </div>

                            <div x-show="open" class="mt-4">
                                <h3 class="font-bold text-gray-800">Items:</h3>
                                <ul class="list-disc list-inside mt-2">
                                    @foreach ($order->items as $item)
                                        <li class="mb-2">
                                            <p><strong>Product Name:</strong> {{ $item['product_name'] ?? 'Unknown Product' }}</p>
                                            <p><strong>Quantity:</strong> {{ $item['quantity'] }}</p>
                                            <p><strong>Price:</strong> Rs. {{ number_format($item['price'], 2) }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
