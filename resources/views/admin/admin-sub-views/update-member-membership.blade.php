<x-guest-layout>
    <x-admin-layout>
        <div class="max-w-4xl mx-auto mt-10 p-6 bg-zeroskill-black border rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6 text-center text-white">Update Membership for {{ $user->name }}</h1>

            <!-- User Details -->
            <div class="mb-6 text-white">
                <p><strong>ID:</strong> {{ $user->id }}</p>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Number:</strong> {{ $user->number }}</p>
                <p><strong>NIC:</strong> {{ $user->nic }}</p>
                <p><strong>Address:</strong> {{ $user->address }}</p>
                <p><strong>Current Membership:</strong>
                    {{ $currentTier->tier_name }} - Rs. {{ number_format($currentTier->price, 2) }}
                    ({{ $currentTier->period }} days)
                </p>
                <p><strong>Membership Start Date:</strong>
                    {{ \Carbon\Carbon::parse($user->membership['start_date'])->format('d M Y') }}
                </p>
                <p><strong>Membership Expiry Date:</strong>
                    {{ \Carbon\Carbon::parse($user->membership['end_date'])->format('d M Y') }}
                </p>
            </div>

            <!-- Update Membership Form -->
            <form action="{{ route('admin.update.member.membership', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Membership Tier Dropdown -->
                <div class="mb-4">
                    <label for="membership_tier" class="block font-bold mb-2 text-white">Select Membership Tier</label>
                    <select name="membership_tier" id="membership_tier" class="w-full border px-4 py-2 rounded text-black" required>
                        <option disabled selected class="text-black">Select a membership tier</option>
                        @foreach ($membershiptiers as $tier)
                            <option class="text-black" value="{{ $tier->id }}"
                                {{ isset($user->membership['tier_id']) && $user->membership['tier_id'] == $tier->id ? 'selected' : '' }}>
                                {{ $tier->tier_name }} - Rs. {{ number_format($tier->price, 2) }} ({{ $tier->period }} days)
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Update Button -->
                <div class="text-right">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded transition duration-300">
                        Update Membership
                    </button>
                </div>
            </form>

            <!-- Cancel Membership Form -->
            <div class="mt-4 text-right">
                <form action="{{ route('admin.cancel.member.membership', $user->id) }}" method="POST" x-data>
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="if (confirm('Are you sure you want to cancel this membership?')) $event.target.closest('form').submit();"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded transition duration-300">
                        Cancel Membership
                    </button>
                </form>
            </div>

        </div>
    </x-admin-layout>
</x-guest-layout>
