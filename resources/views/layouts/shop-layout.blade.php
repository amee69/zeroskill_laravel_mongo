<div x-data="{ open: false }" class="mx-auto flex flex-row py-40 overflow-x-hidden bg-zeroskill-black text-gray-300">
    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col items-center justify-center p-2 md:pl-6">
        <div class="flex justify-start p-2">
            <h1 id="start" class="font-bold text-3xl md:text-5xl text-white tracking-wider">
                Explore Our Products
            </h1>
        </div>

        @livewire('search-bar')

        <!-- Admin Tabs Navigation in a Rectangle Container -->
        <div class="rounded-lg shadow-lg w-full max-w-full p-4 md:p-8 bg-zeroskill-black text-gray-300">
            <!-- Toggle Button for Small Screens -->
            <span 
                @click="open = !open" 
                class="lg:hidden top-4 right-4 bg-gray-800 text-gray-100 text-xl p-2 rounded-md shadow-md cursor-pointer z-10 hover:bg-gray-700 transition">
                ☰
            </span>

            <!-- Sidebar and Content Wrapper -->
            <div class="flex flex-col md:flex-row space-y-4 md:space-y-0">
                <!-- Sidebar for Large Screens -->
                <aside class="w-full md:w-48 bg-zeroskill-black text-gray-300 rounded-lg shadow-lg border border-white hidden lg:block p-4">
                    <a  href="{{ route('shop') }}" class="text-xl font-bold text-white mb-8 pl-2">All Categories</a> 
                    <ul class="pl-1/2"> <!-- Added padding to the left -->
                        @foreach ($categories as $category)
                            <li class="mb-2"> <!-- Added margin between items -->
                                <a href="{{ route('shop.category', $category->category_name) }}" 

                                    {{-- below is only for the styling of the name --}}
                                   class="block p-2 rounded-md transition hover:bg-gray-700 hover:text-white 
                                          {{ request()->is('shop/category/'.$category->category_name) ? 'bg-gray-700 text-white font-bold' : '' }}">
                                   {{ $category->category_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                <!-- Main Content Area -->
                <main class="flex-1 p-2 md:p-6 rounded-md bg-zeroskill-black text-gray-300 shadow-inner">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <!-- Sidebar for Small Screens -->
    <aside 
        class="fixed top-0 left-0 w-64 h-full bg-zeroskill-black text-gray-300 p-6 shadow-lg border border-white transform transition-transform duration-300 lg:hidden z-[9999]"
        :class="{ '-translate-x-full': !open, 'translate-x-0': open }">
        <h2 class="text-xl font-bold text-white mb-6 pl-4">All Categories</h2> <!-- Added padding and spacing -->
        <ul class="pl-4"> <!-- Added padding to the left -->
            @foreach ($categories as $category)
                <li class="mb-2"> <!-- Added margin between items -->
                    <a href="{{ route('shop.category', $category->category_name) }}" 
                       class="block p-2 rounded-md transition hover:bg-gray-700 hover:text-white 
                              {{ request()->is('shop/category/'.$category->category_name) ? 'bg-gray-700 text-white font-bold' : '' }}">
                       {{ $category->category_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>

    <!-- Overlay for Small Screens -->
    <div 
        x-show="open" 
        @click="open = false" 
        class="fixed inset-0 bg-black bg-opacity-50 lg:hidden z-[9998] transition-opacity duration-300"
        x-cloak>
    </div>

    @livewireScripts 
</div>
