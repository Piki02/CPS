<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ __("Welcome back, :name!", ['name' => Auth::user()->name]) }}</h3>
                    <p class="text-gray-600">{{ __("You are logged in as a") }} <span class="font-bold text-cps-blue">{{ Auth::user()->roles->first()->name ?? 'User' }}</span>.</p>
                </div>
            </div>

            @role('Admin')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ __('Admin Actions') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('users.index') }}" class="block p-6 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200 transition duration-300">
                            <h4 class="text-lg font-bold text-cps-blue mb-2">{{ __('Manage Users') }}</h4>
                            <p class="text-gray-600">{{ __('View, create, edit, and delete users.') }}</p>
                        </a>
                        <a href="{{ route('products.index') }}" class="block p-6 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200 transition duration-300">
                            <h4 class="text-lg font-bold text-cps-blue mb-2">{{ __('Manage Products') }}</h4>
                            <p class="text-gray-600">{{ __('Add new products, update prices, and manage inventory.') }}</p>
                        </a>
                         <a href="{{ route('categories.index') }}" class="block p-6 bg-gray-50 hover:bg-gray-100 rounded-lg border border-gray-200 transition duration-300">
                            <h4 class="text-lg font-bold text-cps-blue mb-2">{{ __('Manage Categories') }}</h4>
                            <p class="text-gray-600">{{ __('Organize products into categories.') }}</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Product Import Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-8">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-cps-blue mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-800">{{ __('Import Products') }}</h3>
                    </div>
                    <p class="text-gray-600 mb-6">{{ __('Upload a CSV or Excel file to bulk import products into your catalog.') }}</p>
                    
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-cps-blue transition duration-200">
                            <input type="file" name="file" id="file-upload" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-3 file:px-6
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-cps-blue
                                hover:file:bg-blue-100 file:cursor-pointer
                                cursor-pointer
                            " required accept=".csv,.xlsx,.xls">
                            <p class="mt-2 text-xs text-gray-500">{{ __('Supported formats: CSV, XLSX, XLS') }}</p>
                        </div>
                        <button type="submit" class="bg-cps-blue text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-800 transition duration-300 shadow-md inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            {{ __('Import Products') }}
                        </button>
                    </form>
                    
                    @if(session('success'))
                        <div class="mt-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endrole

            @role('Branch Store')
            <!-- Management Actions -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">{{ __('Management') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <a href="{{ route('products.index') }}" class="block p-6 bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl border-2 border-blue-200 hover:border-cps-blue transition duration-300 group transform hover:-translate-y-1">
                            <div class="flex items-center mb-3">
                                <svg class="w-10 h-10 text-cps-blue mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <h4 class="text-xl font-bold text-cps-blue">{{ __('Products') }}</h4>
                            </div>
                            <p class="text-gray-600">{{ __('Manage your product catalog') }}</p>
                        </a>
                        
                        <a href="{{ route('categories.index') }}" class="block p-6 bg-gradient-to-br from-indigo-50 to-indigo-100 hover:from-indigo-100 hover:to-indigo-200 rounded-xl border-2 border-indigo-200 hover:border-indigo-600 transition duration-300 group transform hover:-translate-y-1">
                            <div class="flex items-center mb-3">
                                <svg class="w-10 h-10 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <h4 class="text-xl font-bold text-indigo-600">{{ __('Categories') }}</h4>
                            </div>
                            <p class="text-gray-600">{{ __('Organize product categories') }}</p>
                        </a>

                        <a href="{{ route('users.index') }}" class="block p-6 bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl border-2 border-purple-200 hover:border-purple-600 transition duration-300 group transform hover:-translate-y-1">
                            <div class="flex items-center mb-3">
                                <svg class="w-10 h-10 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <h4 class="text-xl font-bold text-purple-600">{{ __('Users') }}</h4>
                            </div>
                            <p class="text-gray-600">{{ __('Manage team members') }}</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Store Access Tokens -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-8">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ __('Store Access Tokens') }}</h3>
                        <p class="text-gray-600">{{ __('Generate a temporary access token for customers to view the store.') }}</p>
                    </div>
                    
                    <form action="{{ route('tokens.generate') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="captain_name" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Captain Name') }}
                            </label>
                            <input 
                                type="text" 
                                name="captain_name" 
                                id="captain_name"
                                required
                                placeholder="{{ __('Enter captain name...') }}"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-cps-blue focus:border-cps-blue"
                            >
                            @error('captain_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-cps-blue text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-800 transition duration-300 shadow-md inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ __('Generate New Token') }}
                        </button>
                    </form>
                    
                    @if(session('success'))
                        <div class="mt-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="flex-1">
                                    <p class="font-semibold mb-1">{{ __('Token Generated!') }}</p>
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Orders Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">{{ __('My Orders') }}</h3>
                    </div>
                    @if($orders->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Order ID') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Total') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">${{ number_format($order->total, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-cps-blue hover:text-blue-900">{{ __('View') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No orders found.') }}</p>
                        <a href="{{ route('store') }}" class="mt-4 inline-block bg-cps-blue text-white font-bold py-2 px-4 rounded hover:bg-blue-800 transition duration-300">
                            {{ __('Go to Store') }}
                        </a>
                    @endif
                </div>
            </div>
            @endrole

            @role('Supplier')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue mb-8">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ __('Store Access Tokens') }}</h3>
                    <form action="{{ route('tokens.generate') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-cps-blue text-white font-bold py-2 px-6 rounded-full hover:bg-blue-800 transition duration-300">
                            {{ __('Generate New Token') }}
                        </button>
                    </form>
                    @if(session('success'))
                        <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-cps-blue">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">{{ __('All Orders') }}</h3>
                    @if($orders->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Order ID') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Branch') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Total') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">${{ number_format($order->total, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-cps-blue hover:text-blue-900">{{ __('Process') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No orders received yet.') }}</p>
                    @endif
                </div>
            </div>
            @endrole
        </div>
    </div>
</x-app-layout>
