<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('shop.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Desktop Nav Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

<<<<<<< HEAD
                   @php $isAdmin = auth()->check() && auth()->user()->is_admin; @endphp
<x-nav-link :href="$isAdmin ? route('shop.admin') : route('shop.index')" :active="request()->routeIs($isAdmin ? 'shop.admin' : 'shop.index')">
    🛍 Shop
</x-nav-link>


                    @unless($isAdmin)
    <x-nav-link :href="route('cart.view')" :active="request()->routeIs('cart.view')">
        🛒 Cart
        @if(session('cart') && count(session('cart')) > 0)
            <span class="inline-block bg-red-500 text-white text-xs rounded-full px-2 py-0.5 ml-1">
                {{ array_sum(session('cart')) }}
            </span>
        @endif
    </x-nav-link>
@endunless

=======
                    <x-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                        🛍 Shop
                    </x-nav-link>

                    <x-nav-link :href="route('cart.view')" :active="request()->routeIs('cart.view')">
                        🛒 Cart
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="inline-block bg-red-500 text-white text-xs rounded-full px-2 py-0.5 ml-1">
                                {{ array_sum(session('cart')) }}
                            </span>
                        @endif
                    </x-nav-link>
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
                </div>
            </div>

            <!-- Right Side: User Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center ms-auto">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            @php
                                $image = Auth::user()->image;
                            @endphp
                            <img src="{{ $image ? asset('storage/' . $image) : asset('default-profile.png') }}"
                                 alt="Profile"
                                 class="rounded-full h-8 w-8 object-cover mr-2">
                            <span>{{ Auth::user()->name }}</span>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 
                                    10.586l3.293-3.293a1 1 0 111.414 
                                    1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 
                                    1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else
            <div class="hidden sm:flex sm:items-center ms-auto">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            <svg class="h-6 w-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Guest</span>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 
                                    10.586l3.293-3.293a1 1 0 111.414 
                                    1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 
                                    1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('login')">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            <!-- Hamburger Menu -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Nav -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

<<<<<<< HEAD
           @php $isAdmin = auth()->check() && auth()->user()->is_admin; @endphp
<x-responsive-nav-link :href="$isAdmin ? route('shop.admin') : route('shop.index')" :active="request()->routeIs($isAdmin ? 'shop.admin' : 'shop.index')">
    🛍 Shop
</x-responsive-nav-link>


           @unless($isAdmin)
    <x-responsive-nav-link :href="route('cart.view')" :active="request()->routeIs('cart.view')">
        🛒 Cart
    </x-responsive-nav-link>
@endunless

=======
            <x-responsive-nav-link :href="route('shop.index')" :active="request()->routeIs('shop.index')">
                🛍 Shop
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('cart.view')" :active="request()->routeIs('cart.view')">
                🛒 Cart
            </x-responsive-nav-link>
>>>>>>> d0b1198d88241160778bc1c9999100ca5d441ea5
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
