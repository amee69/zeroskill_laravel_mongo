<div x-data="{ open: false, dropdownOpen: false }" class="fixed z-50 w-full flex justify-center items-center rounded-3xl">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="ml-4">
        <img src="/images/zeroskills2.png" alt="Zero Skill Logo" class="h-[150px]">
    </a>

    <!-- Hamburger button (visible on small screens) -->
    <button @click="open = !open" class="sm:hidden text-white focus:outline-none ml-auto mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Cart Icon -->
    <a href="{{ route('view.cart') }}" class="sm:hidden">
        <img src="{{ asset('images/zeroskillcart.png') }}" class="h-8 mr-4">
    </a>

    <!-- Navigation Links (displayed on large screens and as expanded links on mobile) -->
    <div :class="{ 'block mt-16': open, 'hidden': !open }"
        class="hidden sm:flex flex-col sm:flex-row items-center sm:space-x-8 absolute sm:relative top-16 sm:top-auto left-0 right-0 bg-black/50 backdrop-blur-md rounded-3xl p-6 sm:p-4">
        <ul
            class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-12 text-white font-semibold list-none">
            <li><a href="{{ route('home') }}" class="py-2 px-4 rounded hover:text-gray-300">Home</a></li>
            <li><a href="{{ route('membership') }}" class="py-2 px-4 rounded hover:text-gray-300">Membership</a></li>
            <li><a href="{{ route('shop') }}" class="py-2 px-4 rounded hover:text-gray-300">Shop</a></li>
            <li><a href="{{ route('contact') }}" class="py-2 px-4 rounded hover:text-gray-300">Contact</a></li>

            @auth
                <!-- Add "Controls" for admins next to "Contact" -->
                @if (Auth::user()->role === 'admin')
                    <li><a href="{{ route('controls') }}" class="py-2 px-4 rounded hover:text-gray-300">Controls</a></li>
                @endif

                <!-- Dropdown for large screens -->
                <li class="hidden sm:block">
                    <div @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false" class="relative">
                        <button class="py-2 px-4 hover:text-gray-300 border rounded-full">
                            {{ Auth::user()->name }}
                            <svg class="w-4 h-4 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-black/50 backdrop-blur-md border rounded-md shadow-lg z-20"
                            x-transition>
                            @if (Auth::user()->role === 'normal')
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-white hover:bg-black">Profile</a>
                                <a href="{{ route('orders.history') }}" class="block px-4 py-2 text-white hover:bg-black">My Orders</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-white hover:bg-black">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </li>

                <!-- Links for mobile -->
                @if (Auth::user()->role === 'normal')
                    <li class="sm:hidden"><a href="{{ route('profile.show') }}" class="py-2 px-4 rounded hover:text-gray-300">Profile</a></li>
                    <li class="sm:hidden"><a href="{{ route('orders.history') }}" class="py-2 px-4 rounded hover:text-gray-300">My Orders</a></li>
                @endif
                <li class="sm:hidden">
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 rounded hover:text-gray-300">Logout</button>
                    </form>
                </li>

                {{-- Show cart icon for screens larger than 600px --}}
                <li class="hidden sm:block">
                    <a href="{{ route('view.cart') }}">
                        <img src="{{ asset('images/zeroskillcart.png') }}" class="h-8">
                    </a>
                </li>
            @else
                <li><a href="{{ route('login') }}" class="py-2 px-4 rounded hover:text-gray-300">Login</a></li>
                <li><a href="{{ route('register') }}" class="py-2 px-4 rounded hover:text-gray-300">Register</a></li>
            @endauth
        </ul>
    </div>
</div>
