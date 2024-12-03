<x-guest-layout>
    <x-admin-layout>
      <div class="p-4">
        <h1 class="text-2xl font-bold mb-4">Gym Members</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($members as $member)
            <div class="bg-white shadow-lg rounded-lg p-4">
                <h2 class="text-lg font-bold text-gray-800">{{ $member->name }}</h2>
                <p class="text-sm text-gray-600">NIC: {{ $member->nic }}</p>
                <p class="text-sm text-gray-600">Email: {{ $member->email }}</p>
                <p class="text-sm text-gray-600">Phone: {{ $member->number }}</p>
                <p class="text-sm text-gray-600">Membership Tier: {{ $membershipTiers[$member->id] }}</p>
  
                <div class="flex space-x-2 mt-2">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                </div>
            </div>
            @endforeach
        </div>
    
        <div class="mt-4">
            {{ $members->links() }}
        </div>
      </div>
    </x-admin-layout>
  </x-guest-layout>
  