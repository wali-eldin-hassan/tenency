<nav aria-label="Top" class="relative z-20 bg-white backdrop-blur-xl backdrop-filter">
    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center">
            <!-- Mobile menu toggle, controls the 'mobileMenuOpen' state. -->
            <button type="button" class="p-2 text-gray-400 bg-white rounded-md lg:hidden">
                <span class="sr-only">Open menu</span>
                <!-- Heroicon name: outline/bars-3 -->
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Logo -->
            <div class="flex ml-4 lg:ml-0">
                <a href="/">
                    <span class="sr-only">Your Company</span>
                    <x-application-logo class="w-8 h-8 text-gray-500 fill-current" />
                </a>
            </div>

            <div class="flex items-center ml-12 space-x-8">
                <a href="/" class="relative z-10 flex items-center pt-px -mb-px font-medium text-gray-700 transition-colors duration-200 ease-out border-b-2 border-transparent hover:text-gray-800">
                    Home
                </a>

                <a href="/store" class="relative z-10 flex items-center pt-px -mb-px font-medium text-gray-700 transition-colors duration-200 ease-out border-b-2 border-transparent hover:text-gray-800">
                    Store
                </a>

                @foreach ($categories as $category)
                    <a href="{{ $category->path() }}" class="relative z-10 flex items-center pt-px -mb-px font-medium text-gray-700 transition-colors duration-200 ease-out border-b-2 border-transparent hover:text-gray-800">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center ml-auto">
                <!-- Search -->
                <div class="flex lg:ml-6">
                    <a href="#" class="p-2 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Search</span>
                        <!-- Heroicon name: outline/magnifying-glass -->
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </a>
                </div>

                <!-- Cart -->
                <div class="flow-root ml-4 lg:ml-6">
                    <a href="/cart" class="flex items-center p-2 -m-2 group">
                        <!-- Heroicon name: outline/shopping-bag -->
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ Cart::getTotalQuantity() }}</span>
                        <span class="sr-only">items in cart, view bag</span>
                    </a>
                </div>

                @auth
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('tenant.orders.index')">
                                    {{ __('Orders history') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('tenant.profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('tenant.logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('tenant.logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden ml-6 lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
                        <a href="/login" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</a>
                        <span class="w-px h-6 bg-gray-200" aria-hidden="true"></span>
                        <a href="/register" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create account</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>