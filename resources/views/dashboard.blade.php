<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div
                class="hidden sm:block text-sm text-gray-500 font-medium whitespace-nowrap bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100">
                <span class="text-cps-blue">●</span> {{ now()->format('l, d M Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Banner -->
            <div
                class="relative overflow-hidden bg-cps-blue bg-gradient-to-r from-[#001f3f] to-[#003366] rounded-[2rem] shadow-2xl border border-white/10">
                <div
                    class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl">
                </div>
                <div
                    class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-64 h-64 bg-blue-400/10 rounded-full blur-2xl">
                </div>

                <div class="relative p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-center md:text-left">
                        <h3 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
                            {{ __("Welcome back, :name!", ['name' => Auth::user()->name]) }}
                        </h3>
                        <p class="text-blue-100 text-lg opacity-90 max-w-xl font-medium">
                            {{ __("Here's what's happening with your store today. You have") }}
                            <span class="bg-white/20 px-3 py-1 rounded-lg font-bold backdrop-blur-sm mx-1 text-white">
                                {{ $ordersCount }}
                            </span>
                            {{ __("orders to process.") }}
                        </p>
                    </div>
                    <div class="hidden lg:block">
                        <div class="bg-white/10 backdrop-blur-lg p-6 rounded-2xl border border-white/20 shadow-xl">
                            <p class="text-white/60 text-[10px] uppercase tracking-widest font-bold mb-2">
                                {{ __('Current Session') }}</p>
                            <p class="text-white text-xl font-black">{{ Auth::user()->roles->first()->name ?? 'User' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            @role('Admin|Branch Store')
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Revenue -->
                <div
                    class="group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-4 rounded-2xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <span
                            class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+12.5%</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">
                            {{ __('Total Revenue') }}</p>
                        <h4 class="text-2xl font-black text-gray-900">${{ number_format($totalRevenue, 2) }}</h4>
                    </div>
                </div>

                <!-- Total Orders -->
                <div
                    class="group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-4 rounded-2xl bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">+5.2%</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">
                            {{ __('Total Orders') }}</p>
                        <h4 class="text-2xl font-black text-gray-900">{{ $ordersCount }}</h4>
                    </div>
                </div>

                <!-- Vessels Served -->
                <div
                    class="group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-4 rounded-2xl bg-orange-50 text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">
                            {{ __('Vessels Served') }}</p>
                        <h4 class="text-2xl font-black text-gray-900">{{ $vesselsCount ?? 0 }}</h4>
                    </div>
                </div>

                <!-- Products -->
                <div
                    class="group bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="p-4 rounded-2xl bg-purple-50 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">
                            <?php echo e(__('Total Products')); ?></p>
                        <h4 class="text-2xl font-black text-gray-900">{{ $productsCount }}</h4>
                    </div>
                </div>
            </div>

            <!-- Charts & Lists -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sales Chart -->
                <div class="lg:col-span-2 bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="text-xl font-black text-gray-800 tracking-tight">{{ __('Revenue Overview') }}</h4>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-cps-blue"></span>
                            <span
                                class="text-xs font-bold text-gray-500 uppercase tracking-wider">{{ __('Revenue') }}</span>
                        </div>
                    </div>
                    <div class="h-[350px]">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden relative">
                    <div class="flex items-center justify-between mb-8">
                        <h4 class="text-xl font-black text-gray-800 tracking-tight">{{ __('Top Products') }}</h4>
                        <svg class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="space-y-6">
                        @forelse($topProducts as $item)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center overflow-hidden border border-gray-100 group-hover:border-blue-200 transition-colors shadow-sm">
                                        @if($item->product->image_path)
                                            <img src="{{ asset($item->product->image_path) }}" alt="{{ $item->product->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="text-gray-300 font-bold text-lg cursor-default select-none">
                                                {{ substr($item->product->name, 0, 1) }}</div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-black text-gray-800 truncate w-32 tracking-tight">
                                            {{ $item->product->name }}</p>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-[10px] font-bold text-blue-500 uppercase tracking-widest bg-blue-50 px-2 py-0.5 rounded-full">{{ $item->total_qty }}
                                                {{ __('sold') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-black text-gray-900 tracking-tight">
                                        ${{ number_format($item->product->price * $item->total_qty, 2) }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <div
                                    class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-gray-200">
                                    <svg class="w-10 h-10 text-gray-200" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-gray-400 opacity-60">{{ __('No sales data yet') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            @role('Admin')
            <!-- Import Section -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -tr-y-1/2 translate-x-1/2 transition-all group-hover:bg-blue-100 duration-500">
                </div>

                <div class="relative flex flex-col lg:flex-row items-center justify-between gap-10">
                    <div class="max-w-2xl text-center lg:text-left">
                        <div
                            class="inline-flex items-center gap-2 bg-blue-50 text-cps-blue px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            {{ __('New Feature') }}
                        </div>
                        <h3 class="text-3xl font-black text-gray-800 mb-4 tracking-tight leading-tight">
                            {{ __('Bulk Data Management') }}</h3>
                        <p class="text-gray-500 text-base font-medium leading-relaxed">
                            {{ __('Effortlessly update your global inventory. Upload CSV or Excel files to sync products, prices, and categories in seconds.') }}
                        </p>
                    </div>

                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data"
                        class="w-full lg:w-auto">
                        @csrf
                        <div class="flex flex-col sm:flex-row items-stretch gap-4">
                            <div class="relative flex-1 group/input">
                                <input type="file" name="file" id="file-upload" class="hidden" required
                                    accept=".csv,.xlsx,.xls"
                                    onchange="document.getElementById('file-name').textContent = this.files[0].name; document.getElementById('file-name').classList.add('text-gray-900')">
                                <label for="file-upload"
                                    class="flex items-center gap-4 px-8 py-4 bg-gray-50 hover:bg-white text-gray-400 rounded-2xl cursor-pointer border-2 border-dashed border-gray-200 hover:border-blue-400 transition-all font-bold text-sm min-w-[280px] shadow-inner group-hover/input:shadow-md">
                                    <div class="p-2 bg-white rounded-lg shadow-sm">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <span id="file-name" class="truncate">{{ __('Choose Spreadsheet') }}</span>
                                </label>
                            </div>
                            <button type="submit"
                                class="bg-cps-blue text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-blue-900/20 hover:bg-blue-800 transition-all active:scale-95 text-sm transform">
                                {{ __('Start Import') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endrole
            @endrole

        </div>
    </div>

    <!-- Chart Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('salesChart');
            if (!ctx) return;

            Chart.defaults.font.family = "'Figtree', sans-serif";

            const salesChart = new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($monthlySales->pluck('month')) !!},
                    datasets: [{
                        label: '{{ __("Revenue") }}',
                        data: {!! json_encode($monthlySales->pluck('total')) !!},
                        borderColor: '#002855',
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const { ctx, chartArea } = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                            gradient.addColorStop(0, 'rgba(0, 40, 85, 0)');
                            gradient.addColorStop(1, 'rgba(0, 40, 85, 0.1)');
                            return gradient;
                        },
                        borderWidth: 4,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#002855',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 9,
                        pointHoverBorderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#001c3d',
                            titleFont: { size: 14, weight: '900' },
                            bodyFont: { size: 13, weight: '500' },
                            padding: 16,
                            cornerRadius: 16,
                            displayColors: false,
                            callbacks: {
                                label: (context) => '$' + context.parsed.y.toLocaleString()
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { weight: 'bold', size: 11 }, color: '#94a3b8', padding: 10 }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f8fafc', drawBorder: false },
                            ticks: {
                                font: { weight: 'bold', size: 11 },
                                color: '#94a3b8',
                                padding: 10,
                                callback: (value) => '$' + value.toLocaleString()
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>