<x-guest-layout>
    <x-admin-layout>
        <div class="max-w-4xl mx-auto mt-10 p-6 bg-zeroskill-black border rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6 text-center text-white">Update User Details</h1>

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-3 bg-green-500 text-white rounded text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Name Field -->
                <div class="mb-5">
                    <label for="name" class="block font-bold mb-2 text-white">Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
                </div>

                <!-- Email Field -->
                <div class="mb-5">
                    <label for="email" class="block font-bold mb-2 text-white">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
                </div>

                <!-- Number Field -->
                <div class="mb-5">
                    <label for="number" class="block font-bold mb-2 text-white">Number</label>
                    <input type="text" id="number" name="number" value="{{ $user->number }}" class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
                </div>

                <!-- NIC Field -->
                <div class="mb-5">
                    <label for="nic" class="block font-bold mb-2 text-white">NIC</label>
                    <input type="text" id="nic" name="nic" value="{{ $user->nic }}" class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
                </div>

                <!-- Address Field -->
                <div class="mb-6">
                    <label for="address" class="block font-bold mb-2 text-white">Address</label>
                    <textarea id="address" name="address" class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-black" rows="3">{{ $user->address }}</textarea>
                </div>

                <!-- Buttons Section -->
                <div class="flex justify-end space-x-4">
                    
                    <a href="{{ url()->previous() }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded transition duration-300">
                        Cancel
                    </a>

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded transition duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </x-admin-layout>
</x-guest-layout>
