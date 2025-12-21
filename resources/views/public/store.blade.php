@extends('layouts.public')

@section('content')
    <!-- Welcome Message -->
    @if(session('captain_name'))
    <div class="bg-gradient-to-r from-cps-blue to-blue-700 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center text-white">
                <svg class="w-10 h-10 mr-4 text-cps-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                </svg>
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold mb-1">Dear Master {{ session('captain_name') }}</h1>
                    <p class="text-xl text-blue-100">Welcome to Store</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Hero Header -->
    <div class="relative bg-gradient-to-r from-cps-blue via-blue-700 to-indigo-800 py-16">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl font-extrabold text-white mb-4">{{ __('Product Catalog') }}</h1>
                <p class="text-xl text-blue-100">{{ __('Browse our premium selection of marine and port supplies') }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search and Filters -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border-t-4 border-cps-blue">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <form action="{{ route('store') }}" method="GET">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search products by name...') }}" class="block w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-cps-blue focus:border-cps-blue transition duration-200 text-gray-900 placeholder-gray-400">
                                <button type="submit" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                    <span class="bg-cps-blue text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition font-semibold">
                                        {{ __('Search') }}
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Category Filter -->
                    <div class="lg:w-64">
                        <div class="relative">
                            <select onchange="window.location.href=this.value" class="block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-cps-blue focus:border-cps-blue transition duration-200 text-gray-900 font-medium appearance-none cursor-pointer">
                                <option value="{{ route('store') }}" {{ !request('category') ? 'selected' : '' }}>{{ __('All Categories') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ route('store', ['category' => $category->id]) }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Filters -->
                @if(request('search') || request('category'))
                <div class="mt-4 flex items-center gap-2 flex-wrap">
                    <span class="text-sm text-gray-600 font-medium">{{ __('Active filters:') }}</span>
                    @if(request('search'))
                        <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ __('Search:') }} "{{ request('search') }}"
                            <a href="{{ route('store', ['category' => request('category')]) }}" class="ml-1 hover:text-blue-900">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </span>
                    @endif
                    @if(request('category'))
                        <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ __('Category:') }} {{ $categories->find(request('category'))->name ?? '' }}
                            <a href="{{ route('store', ['search' => request('search')]) }}" class="ml-1 hover:text-indigo-900">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </span>
                    @endif
                    <a href="{{ route('store') }}" class="text-sm text-cps-blue hover:text-blue-800 font-medium">{{ __('Clear all') }}</a>
                </div>
                @endif
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach($products as $product)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 border border-gray-100">
                        <!-- Product Image -->
                        <div class="relative h-56 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden group">
                            @if($product->image_path)
                                <img src="{{ str_starts_with($product->image_path, 'products/') ? asset('storage/' . $product->image_path) : asset($product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            @endif
                            <!-- Category Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="bg-white/90 backdrop-blur-sm text-cps-blue px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem]">{{ $product->name }}</h3>
                            
                            <div class="flex items-baseline justify-between mb-4">
                                <div>
                                    <span class="text-3xl font-extrabold text-cps-blue">${{ number_format($product->price, 2) }}</span>
                                    <span class="text-sm text-gray-500 ml-1">/ {{ $product->unit }}</span>
                                </div>
                            </div>

                            <!-- Add to Cart Button -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-gradient-to-r from-cps-blue to-blue-700 text-white font-bold py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-800 transition duration-300 shadow-md hover:shadow-xl flex items-center justify-center gap-2 group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    {{ __('Add to Cart') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                <div class="bg-white rounded-xl shadow-md p-6">
                    {{ $products->links() }}
                </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-16 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="mb-6">
                            <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ __('No products found') }}</h3>
                        <p class="text-gray-600 mb-6">{{ __('We couldn\'t find any products matching your criteria. Try adjusting your search or filters.') }}</p>
                        <a href="{{ route('store') }}" class="inline-flex items-center gap-2 bg-cps-blue text-white font-bold py-3 px-6 rounded-xl hover:bg-blue-800 transition duration-300 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            {{ __('View All Products') }}
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
