{{-- <!-- Wrapping everything in a single <nav> tag -->
    <nav x-data="{ open: false }" class="fixed z-50 w-full flex justify-center items-center">
        <a href="{{ url('/') }}" class="flex-shrink-0 ml-4">
            <img src="\images\zeroskills2.png" alt="Zero Skill Logo" class="h-[150px]">
        </a>
        <div class="bg-black/50 backdrop-blur-md rounded-3xl p-2 flex items-center space-x-8">
    
            <!-- Navigation Links -->
            <ul class="flex items-center space-x-12">
                <li><a href="{{ route('dashboard') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Home</a></li>
                <li><a href="/membership" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Membership</a></li>
                <li><a href="{{ route('contact') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Contact</a></li>
    
                @auth
                    <li><a href="{{ route('profile.show') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <button type="submit" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Logout</button>
                        </form>
                    </li>
                    
                @else
                    <li><a href="{{ route('login') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Login</a></li>
                    <li><a href="{{ route('register') }}" class="text-white font-semibold py-2 px-4 rounded hover:text-gray-300">Register</a></li>
                    
                @endauth
            </ul>
        </div>

        
    </nav>   --}}

    

{{--     
      
            <nav class="fixed z-50 w-full flex justify-center items-center ">
                <a href="{{ url('/') }}" class="flex-shrink-0 ml-4">
                        <img src="\images\zeroskills2.png" alt="Zero Skill Logo" class="h-[150px]">
                    </a>
                <div class="bg-black/50 backdrop-blur-md rounded-3xl p-2 flex items-center space-x-8">
                    
    
                    <!-- Navigation Links -->
                    <ul class="flex space-x-12">
                        <li><a href="{{ route('home') }}" class="text-white py-1 px-4 rounded-3xl hover:bg-red-900 duration-300">Home</a></li>
                        <li><a href="{{ url('/membership') }}" class="text-white py-1 px-4 rounded-3xl hover:bg-zeroskillMossgreen">Membership</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-white py-1 px-4 rounded-3xl hover:bg-zeroskillMossgreen">Contact</a></li>
    
                        @auth
                            @if (Auth::user()->role === 'normal')
                                <li><a href="{{ url('/profile') }}" class="text-white py-1 px-4 rounded-3xl hover:bg-zeroskillMossgreen">Profile</a></li>
                                <li><a href="{{ url('/logout') }}" class="text-white py-1 px-4 rounded-3xl hover:bg-zeroskillMossgreen">Logout</a></li>
                            @elseif (Auth::user()->role === 'admin')
                                <li><a href="{{ url('/dashboard') }}" class="text-white py-1 px-4 rounded-3xl hover:bg-zeroskillMossgreen">Dashboard</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <button type="submit" class="text-white font-semibold py-1 px-4 hover:text-gray-300">Loghout</button>
                                    </form>
                                </li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}" class="text-white py-1 px-4 rounded-3xl hover:bg-zeroskillMossgreen">Login</a></li>
                        @endauth
                    </ul>
                </div>
            </nav> --}}
        
   














{{-- 




    <!-- Hamburger Menu for Mobile -->
    <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <a href="/membership" class="text-gray-600 hover:text-gray-900 focus:text-gray-900 block font-semibold">
                Membership
            </a>
            <x-responsive-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav> --}}
