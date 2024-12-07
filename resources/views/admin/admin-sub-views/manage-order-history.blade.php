<x-guest-layout>
    <!-- Dashboard Layout -->
    <x-admin-layout>
        <x-adminCategory-layout>
            <h2 class="text-xl font-semibold mb-4 text-center">Order History</h2>


            <!-- Orders Table -->
            <table class="w-full mt-6 border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">#</th>
                        <th class="border px-4 py-2">Order ID</th>
                        <th class="border px-4 py-2">Order Date</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Total Amount</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $order->id }}</td>
                        <td class="border px-4 py-2">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="border px-4 py-2">
                            @if ($order->status === 'cancelled')
                                <span class="inline-block bg-red-700 px-2 py-0.5 rounded-full text-white text-xs">
                                    {{ $order->status }}
                                </span>
                            @elseif ($order->status === 'Refunded_Cancelled')
                                <span class="inline-block bg-red-700 px-2 py-0.5 rounded-full text-white text-xs">
                                    {{ $order->status }}
                                </span>
                            @else
                                <span class="inline-block bg-green-700 px-2 py-0.5 rounded-full text-white text-xs">
                                    {{ $order->status }}
                                </span>
                            @endif
                        </td>
                        
                        
                        
                        
                        <td class="border px-4 py-2">Rs.{{ number_format($order->total_amount, 2) }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{route('admin.manage.singleorder.history',$order->id)}}" class="text-blue-500 hover:underline mr-2">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </x-adminCategory-layout>
    </x-admin-layout>
</x-guest-layout>
