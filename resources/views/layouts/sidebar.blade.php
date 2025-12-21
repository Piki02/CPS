<div class="hidden md:flex flex-col w-64 bg-gray-800 h-screen fixed">
    <div class="flex items-center justify-center h-16 bg-gray-900 shadow-md">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('Img/Logo sin Fondo.png') }}" alt="CPS Logo" class="h-10 w-auto">
        </a>
    </div>
    <div class="flex-1 flex flex-col overflow-y-auto">
        <nav class="flex-1 px-2 py-4 space-y-1">


            <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                class="block px-4 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">
                <div class="flex items-center">
                    <svg class="mr-3 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    {{ __('Home') }}
                </div>
            </x-nav-link>

            <x-nav-link :href="route('store')" :active="request()->routeIs('store')"
                class="block px-4 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">
                <div class="flex items-center">
                    <svg class="mr-3 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    {{ __('Store') }}
                </div>
            </x-nav-link>

            @role('Admin|Branch Store|Supplier')
            <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')"
                class="block px-4 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('orders.*') ? 'bg-gray-900 text-white' : '' }}">
                <div class="flex items-center">
                    <svg class="mr-3 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    {{ __('Orders') }}
                </div>
            </x-nav-link>

            <x-nav-link :href="route('tokens.index')" :active="request()->routeIs('tokens.*')"
                class="block px-4 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('tokens.*') ? 'bg-gray-900 text-white' : '' }}">
                <div class="flex items-center">
                    <svg class="mr-3 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11.536 16.464a1.5 1.5 0 00-.44.863l-.429 2.142a.5.5 0 01-.824.23l-1.372-1.372a.5.5 0 01-.13-.49l.568-2.84A1.5 1.5 0 008.464 14.536L6.257 12.257A6 6 0 1118 9z" />
                    </svg>
                    {{ __('Access Tokens') }}
                </div>
            </x-nav-link>
            @endrole

            @role('Admin|Branch Store')
            <div class="mt-8">
                <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    {{ __('Management') }}
                </h3>
                <div class="mt-1 space-y-1">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')"
                        class="block px-4 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('products.*') ? 'bg-gray-900 text-white' : '' }}">
                        <div class="flex items-center">
                            <svg class="mr-3 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            {{ __('Products') }}
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')"
                        class="block px-4 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('categories.*') ? 'bg-gray-900 text-white' : '' }}">
                        <div class="flex items-center">
                            <svg class="mr-3 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            {{ __('Categories') }}
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                        class="block px-4 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 {{ request()->routeIs('users.*') ? 'bg-gray-900 text-white' : '' }}">
                        <div class="flex items-center">
                            <svg class="mr-3 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            {{ __('Users') }}
                        </div>
                    </x-nav-link>
                </div>
            </div>
            @endrole
        </nav>
        <div class="border-t border-gray-700 p-4">
            <!-- Exchange Rate (Admin & Branch Store) -->
            @role('Admin|Branch Store')
            <div class="mb-4 px-2">
                @php
                    $currentRate = \App\Models\Setting::where('key', 'exchange_rate')->value('value') ?? 7.8;
                @endphp
                <form action="{{ route('dashboard.update-exchange-rate') }}" method="POST"
                    class="bg-gray-700 p-2 rounded-md">
                    @csrf
                    <label class="block text-xs text-gray-400 mb-1">{{ __('USD to GTQ Rate') }}</label>
                    <div class="flex gap-1">
                        <input type="number" step="0.000001" name="exchange_rate" value="{{ $currentRate }}"
                            class="w-full px-2 py-1 text-sm bg-gray-600 border border-gray-500 rounded text-white focus:ring-cps-blue focus:border-cps-blue">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
            @endrole

            <!-- Language Switcher -->
            <div class="flex justify-center space-x-4 mb-4">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                        class="text-sm font-medium {{ App::getLocale() == $localeCode ? 'text-white font-bold underline' : 'text-gray-400 hover:text-white' }}">
                        {{ strtoupper($localeCode) }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-8 w-8 rounded-full bg-gray-500 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-medium text-gray-400 group-hover:text-gray-300">{{ __('View Profile') }}</p>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">
                    {{ __('Profile') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>