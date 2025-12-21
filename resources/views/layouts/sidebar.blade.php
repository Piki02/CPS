<div class="hidden md:flex flex-col w-72 bg-gradient-to-b from-[#001c3d] to-[#000d1a] h-screen fixed shadow-2xl z-50">
    <!-- Brand / Logo -->
    <div class="flex items-center justify-center h-24 px-6">
        <a href="{{ route('dashboard') }}" class="group transition-transform duration-300 hover:scale-105">
            <img src="{{ asset('Img/Logo sin Fondo.png') }}" alt="CPS Logo" class="h-14 w-auto drop-shadow-[0_0_8px_rgba(255,255,255,0.3)]">
        </a>
    </div>

    <!-- Navigation -->
    <div class="flex-1 flex flex-col overflow-y-auto px-4 py-6 no-scrollbar">
        <nav class="space-y-2">
            <!-- Section: General -->
            <div class="mb-6">
                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-[2px] mb-4">{{ __('General') }}</p>
                
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('home') ? 'bg-white/10 text-white shadow-lg backdrop-blur-md' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                    <div class="flex items-center w-full">
                        <div class="p-2 rounded-lg mr-3 transition-colors {{ request()->routeIs('home') ? 'bg-blue-500/20 text-blue-400' : 'bg-gray-800/50 text-gray-500 group-hover:text-gray-300' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold">{{ __('Home') }}</span>
                    </div>
                </x-nav-link>

                <x-nav-link :href="route('store')" :active="request()->routeIs('store')"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('store') ? 'bg-white/10 text-white shadow-lg backdrop-blur-md' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }} mt-2">
                    <div class="flex items-center w-full">
                        <div class="p-2 rounded-lg mr-3 transition-colors {{ request()->routeIs('store') ? 'bg-indigo-500/20 text-indigo-400' : 'bg-gray-800/50 text-gray-500 group-hover:text-gray-300' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold">{{ __('Store') }}</span>
                    </div>
                </x-nav-link>
            </div>

            @role('Admin|Branch Store|Supplier')
            <!-- Section: Commerce -->
            <div class="mb-6">
                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-[2px] mb-4">{{ __('Commerce') }}</p>
                
                <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('orders.*') ? 'bg-white/10 text-white shadow-lg backdrop-blur-md' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                    <div class="flex items-center w-full">
                        <div class="p-2 rounded-lg mr-3 transition-colors {{ request()->routeIs('orders.*') ? 'bg-emerald-500/20 text-emerald-400' : 'bg-gray-800/50 text-gray-500 group-hover:text-gray-300' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold">{{ __('Orders') }}</span>
                    </div>
                </x-nav-link>

                <x-nav-link :href="route('tokens.index')" :active="request()->routeIs('tokens.*')"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('tokens.*') ? 'bg-white/10 text-white shadow-lg backdrop-blur-md' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }} mt-2">
                    <div class="flex items-center w-full">
                        <div class="p-2 rounded-lg mr-3 transition-colors {{ request()->routeIs('tokens.*') ? 'bg-amber-500/20 text-amber-400' : 'bg-gray-800/50 text-gray-500 group-hover:text-gray-300' }}">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11.536 16.464a1.5 1.5 0 00-.44.863l-.429 2.142a.5.5 0 01-.824.23l-1.372-1.372a.5.5 0 01-.13-.49l.568-2.84A1.5 1.5 0 008.464 14.536L6.257 12.257A6 6 0 1118 9z" />
                            </svg>
                        </div>
                        <span class="text-sm font-semibold">{{ __('Access Tokens') }}</span>
                    </div>
                </x-nav-link>
            </div>
            @endrole

            @role('Admin|Branch Store')
            <!-- Section: Management -->
            <div class="mb-6">
                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-[2px] mb-4">{{ __('Management') }}</p>
                
                <div class="space-y-2">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('products.*') ? 'bg-white/10 text-white shadow-lg backdrop-blur-md' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <div class="flex items-center w-full">
                            <div class="p-2 rounded-lg mr-3 transition-colors {{ request()->routeIs('products.*') ? 'bg-blue-400/20 text-blue-300' : 'bg-gray-800/50 text-gray-500 group-hover:text-gray-300' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold">{{ __('Products') }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('categories.*') ? 'bg-white/10 text-white shadow-lg backdrop-blur-md' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <div class="flex items-center w-full">
                            <div class="p-2 rounded-lg mr-3 transition-colors {{ request()->routeIs('categories.*') ? 'bg-purple-500/20 text-purple-400' : 'bg-gray-800/50 text-gray-500 group-hover:text-gray-300' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold">{{ __('Categories') }}</span>
                        </div>
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')"
                        class="group flex items-center px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('users.*') ? 'bg-white/10 text-white shadow-lg backdrop-blur-md' : 'text-gray-400 hover:bg-white/5 hover:text-gray-200' }}">
                        <div class="flex items-center w-full">
                            <div class="p-2 rounded-lg mr-3 transition-colors {{ request()->routeIs('users.*') ? 'bg-pink-500/20 text-pink-400' : 'bg-gray-800/50 text-gray-500 group-hover:text-gray-300' }}">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold">{{ __('Users') }}</span>
                        </div>
                    </x-nav-link>
                </div>
            </div>
            @endrole
        </nav>
    </div>

    <!-- Bottom Actions -->
    <div class="p-6 bg-[#001226]/50 backdrop-blur-xl border-t border-white/5">
        @role('Admin|Branch Store')
        <div class="mb-6">
            @php
                $currentRate = \App\Models\Setting::where('key', 'exchange_rate')->value('value') ?? 7.8;
            @endphp
            <form action="{{ route('dashboard.update-exchange-rate') }}" method="POST" class="relative group">
                @csrf
                <div class="absolute -top-10 left-0 right-0 bg-blue-600 text-[10px] text-white py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center pointer-events-none">
                    {{ __('USD to GTQ Exchange Rate') }}
                </div>
                <div class="flex items-center bg-gray-900/50 border border-white/10 rounded-xl overflow-hidden focus-within:border-blue-500/50 transition-colors">
                    <span class="pl-3 text-xs text-blue-400 font-bold">$</span>
                    <input type="number" step="0.000001" name="exchange_rate" value="{{ $currentRate }}"
                        class="w-full px-2 py-2 text-xs bg-transparent border-0 text-white focus:ring-0 placeholder-gray-600">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white p-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        @endrole

        <!-- User Profile -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center min-w-0">
                <div class="h-10 w-10 shrink-0 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg border border-white/10">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="ml-3 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <a href="{{ route('profile.edit') }}" class="text-[10px] text-gray-500 hover:text-blue-400 transition-colors uppercase tracking-wider font-bold">
                        {{ __('Edit Profile') }}
                    </a>
                </div>
            </div>
            
            <!-- Lang Switcher (Mini) -->
            <div class="flex gap-1 ml-2">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                        class="text-[9px] font-bold p-1 rounded transition-all {{ App::getLocale() == $localeCode ? 'bg-blue-600 text-white' : 'text-gray-500 hover:text-white' }}">
                        {{ strtoupper($localeCode) }}
                    </a>
                @endforeach
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all duration-300 font-bold text-sm border border-red-500/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
