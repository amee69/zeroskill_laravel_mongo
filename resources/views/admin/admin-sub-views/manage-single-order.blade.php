<x-guest-layout>
    <!-- Dashboard Layout -->
    <x-admin-layout>
        <x-adminCategory-layout>
            <div class="">
                <img class="mx-auto" src="{{ asset('images/order.png') }}" alt="Order Image">
            </div>

            


            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Order Date:</strong> {{ $order->order_date }}</p>

            <p><strong>Shipping Details:</strong></p>
            <div class=" p-2">
                <p>{{ $order->shipping_details['full_name'] }}</p>
                <p>{{ $order->shipping_details['city'] }}</p>
                <p>{{ $order->shipping_details['address'] }}</p>
                <p>{{ $order->shipping_details['house_number'] }}</p>
                <p>{{ $order->shipping_details['phone_number'] }}</p>
            </div>

            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>

            <h3 class="mt-4 text-lg font-bold">Items:</h3>
            <table class="w-full border border-gray-700 text-sm mb-6">
                <thead>
                    <tr class="bg-gray-800 text-gray-200">
                        <th class="border border-gray-600 px-2 py-1 text-left">Product ID</th>
                        <th class="border border-gray-600 px-2 py-1 text-left">Name</th>
                        <th class="border border-gray-600 px-2 py-1 text-center">Qty</th>
                        <th class="border border-gray-600 px-2 py-1 text-center">Price (Rs.)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="bg-gray-900 text-gray-200">
                            <td class="border border-gray-600 px-2 py-1">{{ $item['product_id'] }}</td>
                            <td class="border border-gray-600 px-2 py-1">
                                {{ $item['product_name'] ?? 'Unknown Product' }}</td>
                            <td class="border border-gray-600 px-2 py-1 text-center">{{ $item['quantity'] }}</td>
                            <td class="border border-gray-600 px-2 py-1 text-center">
                                {{ number_format($item['price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>

            <!-- Action Buttons -->
            <div class="mt-6 flex space-x-4">
                <!-- Complete Button -->
                <form action="{{ route('admin.order.complete', $order->id) }}" method="GET">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                        Mark as Completed
                    </button>
                </form>


                <!-- Cancel Button -->
                <form action="" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                        Cancel Order
                    </button>
                </form>
            </div>
        </x-adminCategory-layout>
    </x-admin-layout>
</x-guest-layout>
