<x-guest-layout>
    <!-- resources/views/admin/dashboard.blade.php -->
    <x-admin-layout>
        <h1 class="text-3xl font-bold mb-6 text-White">MemberShip Tiers</h1>

        
        
        <!-- Cards to display membership tiers -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="flex items-center justify-center  border-2 border-dashed border-gray-300 rounded-lg hover:border-gray-200 hover:bg-gray-200 transition">
                <a href="{{ route('addtier') }}" class=" flex flex-col items-center justify-center text-gray-500 hover:text-gray-700">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                  </svg>
                  <span class="text-sm font-medium">Add New Tier</span>
                </a>
              </div>
              
            @foreach ($membershiptiers as $tier)



                <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow flex flex-col justify-between">
                    <!-- Header Section -->
                    <div class="bg-gradient-to-r from-zeroskill-black to-red-700 text-white px-4 py-3">
                        <h2 class="text-lg font-semibold">{{ $tier->tier_name }}</h2>
                    </div>

                    <!-- Content Section -->
                    <div class="p-4 flex-grow">
                        <p class="text-gray-600 text-sm mb-3">{{ $tier->description }}</p>
                        <div class="text-sm text-gray-700 space-y-2">
                            <p><span class="font-medium">Price:</span> Rs.{{ $tier->price }}</p>
                            <p><span class="font-medium">Period:</span> {{ $tier->period }} Days</p>
                            <p><span class="font-medium">Created At:</span> {{ $tier->created_at ?? 'N/A' }}</p>
                            <p><span class="font-medium">Updated At:</span> {{ $tier->updated_at ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Footer Section -->
                    <div class="bg-zeroskill-black px-4 py-3 flex justify-between items-center mt-auto">
                        <a href="{{ route('managetier', ['id' => $tier->id]) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                            Edit
                        </a>
                        
                        <form action="{{route('managetier.delete',['id' => $tier->id])}}" method="GET">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </x-admin-layout>
</x-guest-layout>
