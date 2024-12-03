<x-guest-layout>
  <!-- resources/views/admin/dashboard.blade.php -->
  <x-admin-layout>
    @foreach ($tiers as $tier)
    
      <h1 class="text-3xl font-bold mb-6 text-center">Edit Membership Tier - {{$tier->tier_name}}</h1>

      <form action=" {{ route('managetier.update', ['id' => $tier->id]) }}" method="GET" class="max-w-xl mx-auto bg-gray-300 shadow-md rounded-md p-6">
        @csrf <!-- CSRF token for security -->
        
        <div class="mb-4">
          <label for="tier_name" class="block text-sm font-medium text-gray-900">Tier Name</label>
          <input type="text" name="tier_name" id="tier_name" value="{{ $tier->tier_name }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-black">
        </div>

        <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
          <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md shadow-sm text-black border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $tier->description }}</textarea>
        </div>

        <div class="mb-4">
          <label for="price" class="block text-sm font-medium text-gray-700">Price (Rs.)</label>
          <input type="number" name="price" id="price" value="{{ $tier->price }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-black">
        </div>

        <div class="mb-4">
          <label for="period" class="block text-sm font-medium text-gray-700">Period (Months)</label>
          <input type="number" name="period" id="period" value="{{ $tier->period }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-black">
        </div>

        <div class="flex items-center justify-between">
          <button type="submit" class="bg-zeroskill-green text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors">Update</button>
          <a href="{{route('admin.membership.tiers')}}" class="text-sm font-medium text-red-500 hover:underline">Cancel</a>
        </div>
      </form>
    @endforeach
  </x-admin-layout>
</x-guest-layout>
