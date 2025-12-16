<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-cps-blue transition duration-150">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            {{ __('Back to Dashboard') }}
                        </a>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center gap-4">
                            <h2 class="text-2xl font-bold">{{ __('Order Information') }}</h2>
                            <a href="{{ route('orders.quotation', $order) }}" target="_blank" class="bg-gray-800 text-white text-sm px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-150 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                {{ __('Generate Quotation') }}
                            </a>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold 
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'confirmed') bg-blue-100 text-blue-800
                            @elseif($order->status == 'completed') bg-green-100 text-green-800
                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">{{ __('Customer Information') }}</h3>
                            <p><span class="font-medium">{{ __('Captain Name:') }}</span> {{ $order->captain_name }}</p>
                            <p><span class="font-medium">{{ __('Vessel Name:') }}</span> {{ $order->vessel_name ?? 'N/A' }}</p>
                            <p><span class="font-medium">{{ __('Date:') }}</span> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                            @if($order->token)
                                <p><span class="font-medium">{{ __('Token Used:') }}</span> {{ $order->token }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Order Items -->
                    <h3 class="text-lg font-semibold mb-4">{{ __('Order Items') }}</h3>
                    <div class="overflow-x-auto mb-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Product') }}</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Quantity') }}</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Unit Price') }}</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Subtotal') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($item->product->image_path)
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($item->product->image_path) }}" alt="">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                        ${{ number_format($item->unit_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                                        ${{ number_format($item->subtotal, 2) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500">{{ __('Subtotal') }}</td>
                                    <td class="px-6 py-3 text-right text-sm font-bold text-gray-900">${{ number_format($order->total, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Order Management Form -->
                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-bold mb-4 text-gray-800">{{ __('Manage Order') }}</h3>
                        <form action="{{ route('orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Order Status') }}</label>
                                    <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-cps-blue focus:ring-cps-blue">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>{{ __('Confirmed') }}</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                                    </select>
                                </div>

                                <!-- Financials -->
                                <div class="space-y-4">
                                    <div>
                                        <label for="discount_percentage" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Discount (%)') }}</label>
                                        <input type="number" step="0.01" name="discount_percentage" id="discount_percentage" value="{{ old('discount_percentage', $order->discount_percentage) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-cps-blue focus:ring-cps-blue">
                                    </div>
                                    <div>
                                        <label for="tax" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Tax ($)') }}</label>
                                        <input type="number" step="0.01" name="tax" id="tax" value="{{ old('tax', $order->tax) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-cps-blue focus:ring-cps-blue">
                                    </div>
                                    <div>
                                        <label for="shipping_cost" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Transportation Cost ($)') }}</label>
                                        <input type="number" step="0.01" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', $order->shipping_cost) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-cps-blue focus:ring-cps-blue">
                                    </div>
                                </div>
                            </div>

                            <!-- Grand Total Calculation Preview -->
                            <div class="mt-6 border-t border-gray-200 pt-4">
                                <div class="flex justify-end text-lg">
                                    <span class="font-bold mr-4">{{ __('Grand Total:') }}</span>
                                    <span class="font-bold text-cps-blue">
                                        ${{ number_format($order->total - $order->discount + $order->tax + $order->shipping_cost, 2) }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 text-right mt-1">{{ __('(Calculated as: Subtotal - Discount + Tax + Shipping)') }}</p>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="bg-cps-blue text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-150 font-semibold shadow-md">
                                    {{ __('Update Order') }}
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
