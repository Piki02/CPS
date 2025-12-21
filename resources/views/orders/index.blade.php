<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Orders Management') }}
                </h2>
                <p class="text-sm font-medium text-gray-500 mt-1">{{ __('Monitor and process supply requests from all branches.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                 <div class="px-4 py-2 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ __('Total Orders') }}</p>
                    <p class="text-lg font-black text-cps-blue">
                        {{ collect($ordersByStatus)->flatten()->count() }}
                    </p>
                 </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            @php
                $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
                $statusConfig = [
                    'pending' => [
                        'title' => 'Pending Review',
                        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'amber',
                        'bg' => 'bg-amber-500',
                        'text' => 'text-amber-600',
                        'light' => 'bg-amber-50',
                        'border' => 'border-amber-100'
                    ],
                    'confirmed' => [
                        'title' => 'Confirmed & In Progress',
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                        'color' => 'blue',
                        'bg' => 'bg-blue-500',
                        'text' => 'text-blue-600',
                        'light' => 'bg-blue-50',
                        'border' => 'border-blue-100'
                    ],
                    'completed' => [
                        'title' => 'Completed Orders',
                        'icon' => 'M5 13l4 4L19 7',
                        'color' => 'emerald',
                        'bg' => 'bg-emerald-500',
                        'text' => 'text-emerald-600',
                        'light' => 'bg-emerald-50',
                        'border' => 'border-emerald-100'
                    ],
                    'cancelled' => [
                        'title' => 'Cancelled / Denied',
                        'icon' => 'M6 18L18 6M6 6l12 12',
                        'color' => 'rose',
                        'bg' => 'bg-rose-500',
                        'text' => 'text-rose-600',
                        'light' => 'bg-rose-50',
                        'border' => 'border-rose-100'
                    ]
                ];
            @endphp

            @foreach($statuses as $status)
                @if(isset($ordersByStatus[$status]) && $ordersByStatus[$status]->count() > 0)
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 px-2">
                            <div class="w-1.5 h-6 rounded-full {{ $statusConfig[$status]['bg'] }}"></div>
                            <h3 class="text-xl font-black text-gray-800 tracking-tight">{{ __($statusConfig[$status]['title']) }}</h3>
                            <span class="ml-auto text-[10px] font-black {{ $statusConfig[$status]['text'] }} {{ $statusConfig[$status]['light'] }} border {{ $statusConfig[$status]['border'] }} px-3 py-1 rounded-full uppercase tracking-widest">
                                {{ $ordersByStatus[$status]->count() }} {{ __('Items') }}
                            </span>
                        </div>

                        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden px-4">
                            <table class="min-w-full divide-y-8 divide-white border-separate border-spacing-y-4">
                                <thead class="bg-white sticky top-0 z-10">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">{{ __('Order Reference') }}</th>
                                        @role('Admin|Supplier')
                                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">{{ __('Branch / User') }}</th>
                                        @endrole
                                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px] hidden md:table-cell">{{ __('Placed On') }}</th>
                                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">{{ __('Total Value') }}</th>
                                        <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[2px]">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ordersByStatus[$status] as $order)
                                        <tr class="group hover:bg-{{ $statusConfig[$status]['color'] }}-50/30 transition-all duration-300">
                                            <td class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-l-[2rem] border-y border-l border-transparent group-hover:{{ $statusConfig[$status]['border'] }} transition-all shadow-sm">
                                                <div class="flex items-center gap-3">
                                                    <div class="p-2.5 {{ $statusConfig[$status]['light'] }} {{ $statusConfig[$status]['text'] }} rounded-xl">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                                    </div>
                                                    <span class="text-sm font-black text-gray-900 tracking-wider">#{{ $order->id }}</span>
                                                </div>
                                            </td>
                                            @role('Admin|Supplier')
                                            <td class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:{{ $statusConfig[$status]['border'] }} transition-all shadow-sm">
                                                <p class="text-sm font-bold text-gray-700 truncate w-40">{{ $order->user->name }}</p>
                                            </td>
                                            @endrole
                                            <td class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:{{ $statusConfig[$status]['border'] }} transition-all shadow-sm hidden md:table-cell">
                                                <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter">{{ $order->created_at->format('M d, Y') }}</p>
                                            </td>
                                            <td class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:{{ $statusConfig[$status]['border'] }} transition-all shadow-sm">
                                                <p class="text-base font-black text-gray-900 tracking-tight">${{ number_format($order->total, 2) }}</p>
                                            </td>
                                            <td class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-r-[2rem] border-y border-r border-transparent group-hover:{{ $statusConfig[$status]['border'] }} text-right transition-all shadow-sm">
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('orders.show', $order) }}" 
                                                        class="px-4 py-2 text-xs font-black uppercase tracking-widest bg-white border border-gray-200 rounded-xl hover:bg-gray-900 hover:text-white hover:border-black transition-all">
                                                        {{ __('Details') }}
                                                    </a>
                                                    @role('Admin')
                                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-2.5 text-red-500 bg-white border border-gray-200 rounded-xl hover:bg-red-500 hover:text-white hover:border-red-500 transition-all delete-btn">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                        </button>
                                                    </form>
                                                    @endrole
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach

            @if(collect($ordersByStatus)->flatten()->count() === 0)
                <div class="py-24 text-center">
                    <div class="bg-white w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 border border-gray-100 shadow-sm">
                        <svg class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <h4 class="text-2xl font-black text-gray-800">{{ __('No orders found') }}</h4>
                    <p class="text-gray-500 font-medium mt-2">{{ __('Transactions and requests will appear here once processed.') }}</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
