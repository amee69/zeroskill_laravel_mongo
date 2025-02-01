<x-guest-layout>
    <x-admin-layout>
        <x-adminCategory-layout>

            <div class="max-w-4xl mx-auto mt-10 p-6 shadow-lg rounded-lg">
                <h1 class="text-2xl font-bold mb-6 text-center">Cancel Order</h1>

                <!-- Order Details -->
                <div class="mb-6 border-b pb-4">
                    <p class="text-lg"><strong>Order ID:</strong> {{ $order->id }}</p>
                    <p class="text-lg"><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p class="text-lg">
                        <strong>Order Status:</strong>
                        <span class="inline-block px-2 py-1 rounded 
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                               ($order->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p class="text-lg">
                        <strong>Payment Status:</strong>
                        <span class="inline-block px-2 py-1 rounded 
                            {{ $order->payment_method === 'cash_on_delivery' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                            {{ $order->payment_method === 'cash_on_delivery' ? 'Pending' : 'Paid' }}
                        </span>
                    </p>
                </div>

                <!-- Cancellation Form -->
                <div class="mt-6">
                    <form action="{{ route('admin.order.cancel.process', $order->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="cancellation_reason" class="block font-bold mb-2">Cancellation Reason:</label>
                            <textarea name="cancellation_reason" id="cancellation_reason" cols="30" rows="4" class="text-black w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Enter the reason for cancellation..." required></textarea>
                        </div>

                        <div class="flex justify-end space-x-4">
                            @if ($order->payment_method === 'cash_on_delivery')
                                <!-- Cancel Button for Cash on Delivery -->
                                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600 transition duration-300">
                                    Cancel Order
                                </button>
                            @elseif ($order->payment_method === 'card_payment')
                                <!-- Refund and Cancel Buttons for Card Payment -->
                                <button type="submit" name="action" value="refund" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition duration-300">
                                    Refund and Cancel Order
                                </button>
                            @endif
                        </div>
                    </form>
                </div>

            </div>

        </x-adminCategory-layout>
    </x-admin-layout>
</x-guest-layout>
