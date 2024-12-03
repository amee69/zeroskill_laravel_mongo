<div class="mx-auto flex flex-col items-center justify-center py-40">
    <!-- Admin Tabs Navigation in a Rectangle Container -->
    <div class="bg-zeroskill-royalred rounded-lg shadow-lg w-full max-w-[117rem] p-8 md:p-10 border">
        <nav class="bg-zeroskill-black rounded-md shadow mb-6 p-2">
            <div class="flex justify-center space-x-8 border-b">
                <a href="{{ route('admin.members') }}"
                   class="text-white hover:text-gray-300 px-6 py-2 border-b-2 transition-colors duration-200 {{ request()->routeIs('admin.members') ? 'border-white' : 'border-transparent hover:border-gray-400' }}">
                   Members
                </a>
                <a href="{{ route('admin.membership.tiers') }}"
                   class="text-white hover:text-gray-300 px-6 py-2 border-b-2 transition-colors duration-200 {{ request()->routeIs('admin.membership.tiers') ? 'border-white' : 'border-transparent hover:border-gray-400' }}">
                   Membership Tiers
                </a>
                <a href="{{ route('admin.shop') }}"
                   class="text-white hover:text-gray-300 px-6 py-2 border-b-2 transition-colors duration-200 {{ request()->routeIs('admin.shop') ? 'border-white' : 'border-transparent hover:border-gray-400' }}">
                   Shop
                </a>
                <a href="{{ route('admin.registered.users') }}"
                   class="text-white hover:text-gray-300 px-6 py-2 border-b-2 transition-colors duration-200 {{ request()->routeIs('admin.registered.users') ? 'border-white' : 'border-transparent hover:border-gray-400' }}">
                   Registered Users
                </a>
            </div>
            
        </nav>

        <!-- Main Content Area -->
        @livewireStyles
        <main class="border p-6 rounded-md shadow-inner">
            {{ $slot }}
        </main>
        @livewireScripts
    </div>
</div>
