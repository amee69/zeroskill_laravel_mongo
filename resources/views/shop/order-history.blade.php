<x-guest-layout>
    <div class="mx-auto flex flex-col items-center py-40 text-black">
        <div class="w-full max-w-6xl p-8 border rounded-lg shadow-lg bg-white">
            <h1 class="text-center font-bold text-4xl tracking-wider text-gray-800 mb-8">
                My Orders
            </h1>

            @if ($orders->isEmpty())
                <p class="text-center text-gray-600 text-lg">You have not placed any orders yet.</p>
            @else
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div x-data="{ open: false }" class="border rounded-lg p-6 bg-gray-100">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800">
                                        Order ID: {{ $order->_id }}
                                    </h2>
                                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                                    <p><strong>Order Date:</strong>
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y, h:i A') }}
                                    </p>
                                    <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
                                </div>
                                <button @click="open = !open"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-md transition">
                                    <span x-show="!open">View Items</span>
                                    <span x-show="open">Hide Items</span>
                                </button>
                            </div>

                            <div x-show="open"   class="mt-4">
                                <h3 class="font-bold text-gray-800">Items:</h3>
                                <ul class="list-disc list-inside mt-2">
                                    @foreach ($order->items as $item)
                                        <li>
                                            Product Name: {{ $item['product_name'] ?? 'Unknown Product' }}<br>
                                            Quantity: {{ $item['quantity'] }}<br>
                                            Price: Rs. {{ number_format($item['price'], 2) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
