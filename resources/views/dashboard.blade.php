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

            <!-- Admin Actions removed as they are now in sidebar -->

            <!-- Reporting Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">{{ __('Sales Report') }}</h3>
                </div>
                
                <div>
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <!-- Total Revenue -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-green-500 p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Total Revenue') }}</p>
                                    <p class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Orders -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-blue-500 p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Total Orders') }}</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $ordersCount }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vessels Served -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-orange-500 p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-orange-100 text-orange-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Vessels Served') }}</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $vesselsCount ?? 0 }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Products -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-purple-500 p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100 text-purple-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Total Products') }}</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $productsCount }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Best Selling Product -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-red-500 p-6 col-span-1 md:col-span-4 lg:col-span-1">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Best Selling') }}</p>
                                    <p class="text-lg font-bold text-gray-900 truncate w-32" title="{{ $bestSellingProduct->product->name ?? 'N/A' }}">
                                        {{ $bestSellingProduct->product->name ?? 'N/A' }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $bestSellingProduct->total_qty ?? 0 }} {{ __('sold') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Sales Chart -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <h4 class="text-lg font-bold text-gray-800 mb-4">{{ __('Monthly Sales') }}</h4>
                            <canvas id="salesChart" height="200"></canvas>
                        </div>

                        <!-- Top Products -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <h4 class="text-lg font-bold text-gray-800 mb-4">{{ __('Top Selling Products') }}</h4>
                            @if($topProducts->count() > 0)
                                <ul>
                                    @foreach($topProducts as $item)
                                        <li class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                                    @if($item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-8 h-8 object-cover rounded">
                                                    @else
                                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    @endif
                                                </div>
                                                <span class="text-gray-700 font-medium">{{ $item->product->name }}</span>
                                            </div>
                                            <span class="font-bold text-cps-blue bg-blue-50 px-3 py-1 rounded-full text-sm">{{ $item->total_qty }} {{ __('sold') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500 text-center py-4">{{ __('No sales data available yet.') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    const salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($monthlySales->pluck('month')) !!},
                            datasets: [{
                                label: '{{ __("Sales ($)") }}',
                                data: {!! json_encode($monthlySales->pluck('total')) !!},
                                borderColor: '#002855', // cps-blue
                                backgroundColor: 'rgba(0, 40, 85, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return '$' + value;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
            </script>

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
            <!-- Reporting Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800">{{ __('My Performance') }}</h3>
                </div>
                
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <!-- Total Revenue -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-green-500 p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                     <p class="text-sm font-medium text-gray-600">{{ __('Total Spend') }}</p>
                                     <p class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Orders -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-blue-500 p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Total Orders') }}</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $ordersCount }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vessels Served -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-orange-500 p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-orange-100 text-orange-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Vessels Served') }}</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $vesselsCount ?? 0 }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Best Selling Product -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-red-500 p-6">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">{{ __('Best Selling') }}</p>
                                    <p class="text-lg font-bold text-gray-900 truncate w-32" title="{{ $bestSellingProduct->product->name ?? 'N/A' }}">
                                        {{ $bestSellingProduct->product->name ?? 'N/A' }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $bestSellingProduct->total_qty ?? 0 }} {{ __('sold') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Chart -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-8">
                        <h4 class="text-lg font-bold text-gray-800 mb-4">{{ __('Monthly Spend') }}</h4>
                        <canvas id="branchSalesChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('branchSalesChart').getContext('2d');
                    const branchSalesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($monthlySales->pluck('month')) !!},
                            datasets: [{
                                label: '{{ __("Spend ($)") }}',
                                data: {!! json_encode($monthlySales->pluck('total')) !!},
                                borderColor: '#002855', // cps-blue
                                backgroundColor: 'rgba(0, 40, 85, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return '$' + value;
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
            </script>

            <!-- Management Actions removed as they are now in sidebar -->

            @endrole


        </div>
    </div>
</x-app-layout>
