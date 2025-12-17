<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @php
                $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
                $statusTitles = [
                    'pending' => 'Pending Orders',
                    'confirmed' => 'Confirmed Orders',
                    'completed' => 'Completed Orders',
                    'cancelled' => 'Cancelled Orders'
                ];
                $statusColors = [
                    'pending' => 'border-yellow-400',
                    'confirmed' => 'border-sky-400',
                    'completed' => 'border-green-400',
                    'cancelled' => 'border-red-400'
                ];
            @endphp

            @foreach($statuses as $status)
                @if(isset($ordersByStatus[$status]) && $ordersByStatus[$status]->count() > 0)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 {{ $statusColors[$status] }}">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-2xl font-bold mb-6 text-gray-800">{{ __($statusTitles[$status]) }}</h3>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Order ID') }}</th>
                                            @role('Admin|Supplier')
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Branch') }}</th>
                                            @endrole
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Total') }}</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($ordersByStatus[$status] as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                            @role('Admin|Supplier')
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->user->name }}</td>
                                            @endrole
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">${{ number_format($order->total, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $badgeClasses = [
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        'confirmed' => 'bg-sky-100 text-sky-800',
                                                        'cancelled' => 'bg-red-100 text-red-800',
                                                        'completed' => 'bg-green-100 text-green-800',
                                                    ];
                                                    $badgeClass = $badgeClasses[$order->status] ?? 'bg-gray-100 text-gray-800';
                                                @endphp
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex items-center gap-3">
                                                    <a href="{{ route('orders.show', $order) }}" class="text-cps-blue hover:text-blue-900">{{ __('View Details') }}</a>
                                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="text-red-600 hover:text-red-900 text-sm delete-btn">{{ __('Delete') }}</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const deleteButtons = document.querySelectorAll('.delete-btn');
                    deleteButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            const form = this.closest('.delete-form');
                            
                            Swal.fire({
                                title: '{{ __("Are you sure?") }}',
                                text: '{{ __("You will not be able to recover this order!") }}',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: '{{ __("Yes, delete it!") }}',
                                cancelButtonText: '{{ __("Cancel") }}'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            });
                        });
                    });
                });
            </script>

            @if($ordersByStatus->isEmpty())
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-t-4 border-gray-300">
                    <div class="p-6 text-gray-900 text-center">
                        <p class="text-gray-500 text-lg">{{ __('No orders found.') }}</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
