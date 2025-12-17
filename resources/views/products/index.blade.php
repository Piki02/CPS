<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filters -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-6">
                <div class="p-6">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Search Bar -->
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Search Products') }}</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="search" 
                                        id="search"
                                        value="{{ request('search') }}"
                                        placeholder="{{ __('Search by product name...') }}"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-cps-blue focus:border-cps-blue"
                                    >
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Category') }}</label>
                                <select 
                                    name="category" 
                                    id="category"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-cps-blue focus:border-cps-blue"
                                >
                                    <option value="">{{ __('All Categories') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 flex gap-3">
                            <button type="submit" class="bg-cps-blue text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-800 transition duration-300 inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                {{ __('Search') }}
                            </button>
                            @if(request('search') || request('category'))
                                <a href="{{ route('products.index') }}" class="bg-gray-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-gray-600 transition duration-300 inline-flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    {{ __('Clear Filters') }}
                                </a>
                            @endif
                        </div>

                        <!-- Active Filters Display -->
                        @if(request('search') || request('category'))
                        <div class="mt-4 flex items-center gap-2 flex-wrap">
                            <span class="text-sm text-gray-600 font-medium">{{ __('Active filters:') }}</span>
                            @if(request('search'))
                                <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ __('Search:') }} "{{ request('search') }}"
                                </span>
                            @endif
                            @if(request('category'))
                                <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ __('Category:') }} {{ $categories->find(request('category'))->name ?? '' }}
                                </span>
                            @endif
                        </div>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Products Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">{{ __('Product List') }}</h3>
                        <div class="flex gap-3">
                            <a href="{{ route('products.import-export') }}" class="bg-green-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-700 transition duration-300 inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                {{ __('Import / Export') }}
                            </a>
                            <a href="{{ route('products.export-pdf') }}" class="bg-red-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-700 transition duration-300 inline-flex items-center" target="_blank">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                {{ __('Export PDF') }}
                            </a>
                            <a href="{{ route('products.create') }}" class="bg-cps-blue text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-800 transition duration-300 inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ __('Add New Product') }}
                            </a>
                        </div>
                    </div>



                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($products as $product)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($product->image_path)
                                            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="h-10 w-10 rounded-full object-cover">
                                        @else
                                            <span class="text-gray-400">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-bold">
                                        ${{ number_format($product->price, 2) }}
                                        <div class="text-xs text-gray-500 font-normal">
                                            Q{{ number_format($product->price * ($exchangeRate ?? 7.8), 2) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $product->unit }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">{{ __('Edit') }}</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="text-red-600 hover:text-red-900 delete-btn">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
