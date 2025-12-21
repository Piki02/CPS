<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Products') }}
                </h2>
                <p class="text-sm font-medium text-gray-500 mt-1">
                    {{ __('Manage your inventory and product presentation.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('products.import-export') }}"
                    class="bg-white text-gray-700 font-bold py-2.5 px-5 rounded-2xl border border-gray-200 hover:bg-gray-50 transition-all duration-300 flex items-center shadow-sm text-sm">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    {{ __('Import / Export') }}
                </a>
                <a href="{{ route('products.create') }}"
                    class="bg-cps-blue text-white font-black py-2.5 px-6 rounded-2xl hover:bg-blue-800 transition-all duration-300 flex items-center shadow-lg shadow-blue-900/20 active:scale-95 text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    {{ __('Add Product') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Filters & Search -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                <form action="{{ route('products.index') }}" method="GET" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Search Bar -->
                        <div class="md:col-span-2 relative group">
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">{{ __('Search Inventory') }}</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-cps-blue transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="{{ __('Type to search...') }}"
                                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-cps-blue transition-all font-medium text-gray-700 placeholder-gray-400 shadow-inner">
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="relative group">
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">{{ __('Category') }}</label>
                            <select name="category"
                                class="block w-full px-4 py-3.5 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-cps-blue transition-all font-medium text-gray-700 shadow-inner appearance-none cursor-pointer">
                                <option value="">{{ __('All Categories') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 top-6 pr-4 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-end gap-3">
                            <button type="submit"
                                class="flex-1 bg-gray-900 text-white font-bold py-3.5 px-6 rounded-2xl hover:bg-black transition-all shadow-lg active:scale-95">
                                {{ __('Filter') }}
                            </button>
                            @if(request('search') || request('category'))
                                <a href="{{ route('products.index') }}"
                                    class="p-3.5 bg-gray-100 text-gray-500 rounded-2xl hover:bg-red-50 hover:text-red-500 transition-all shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Products List -->
            <div class="space-y-4">
                @php
                    $exchangeRate = \App\Models\Setting::where('key', 'exchange_rate')->value('value') ?? 7.8;
                @endphp

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden px-4">
                    <table class="min-w-full divide-y-8 divide-white border-separate border-spacing-y-4">
                        <thead class="bg-white sticky top-0 z-10">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                    {{ __('Product') }}</th>
                                <th
                                    class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px] hidden md:table-cell">
                                    {{ __('Category') }}</th>
                                <th
                                    class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                    {{ __('Price') }}</th>
                                <th
                                    class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px] hidden sm:table-cell">
                                    {{ __('Unit') }}</th>
                                <th
                                    class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                                    <td
                                        class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-l-[1.5rem] border-y border-l border-transparent group-hover:border-blue-100 transition-all shadow-sm">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-16 h-16 rounded-2xl bg-white p-1 border border-gray-100 shadow-sm group-hover:scale-110 transition-transform flex-shrink-0 overflow-hidden">
                                                @if($product->image_path)
                                                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}"
                                                        class="w-full h-full object-cover rounded-xl">
                                                @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-300 font-black text-xl">
                                                        {{ substr($product->name, 0, 1) }}</div>
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-base font-black text-gray-900 truncate tracking-tight">
                                                    {{ $product->name }}</p>
                                                <p class="text-[10px] font-bold text-gray-400 truncate md:hidden">
                                                    {{ $product->category->name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-blue-100 transition-all shadow-sm hidden md:table-cell">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                    </td>
                                    <td
                                        class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-blue-100 transition-all shadow-sm">
                                        <div>
                                            <p class="text-base font-black text-gray-900 tracking-tight">
                                                ${{ number_format($product->price, 2) }}</p>
                                            <p
                                                class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2 py-0.5 rounded-lg inline-block mt-1">
                                                Q{{ number_format($product->price * $exchangeRate, 2) }}
                                            </p>
                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-blue-100 transition-all shadow-sm hidden sm:table-cell">
                                        <p
                                            class="text-sm font-bold text-gray-500 lowercase px-3 py-1 bg-white rounded-xl border border-gray-100 inline-block">
                                            {{ $product->unit }}</p>
                                    </td>
                                    <td
                                        class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-r-[1.5rem] border-y border-r border-transparent group-hover:border-blue-100 text-right transition-all shadow-sm">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('products.edit', [$product, 'page' => request('page'), 'search' => request('search'), 'category' => request('category')]) }}"
                                                class="p-2.5 text-cps-blue bg-white rounded-xl border border-gray-200 hover:bg-cps-blue hover:text-white hover:border-cps-blue hover:shadow-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="inline-block delete-form" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2.5 text-red-500 bg-white rounded-xl border border-gray-200 hover:bg-red-500 hover:text-white hover:border-red-500 hover:shadow-lg transition-all delete-btn">
                                                    <svg class="w-5 h-5 pointer-events-none" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center">
                                        <div
                                            class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-gray-200">
                                            <svg class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                        </div>
                                        <h4 class="text-xl font-black text-gray-800">{{ __('Your inventory is empty') }}
                                        </h4>
                                        <p class="text-gray-500 font-medium mt-2">
                                            {{ __('Start by adding your first product to the catalog.') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 px-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>