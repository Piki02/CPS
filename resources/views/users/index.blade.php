<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-800 leading-tight tracking-tight">
                    {{ __('User Management') }}
                </h2>
                <p class="text-sm font-medium text-gray-500 mt-1">{{ __('Manage team access and permissions across the system.') }}</p>
            </div>
            <a href="{{ route('users.create') }}"
                class="bg-cps-blue text-white font-black py-2.5 px-6 rounded-2xl hover:bg-blue-800 transition-all duration-300 flex items-center shadow-lg shadow-blue-900/20 active:scale-95 text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('Create User') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Users List -->
            <div class="space-y-4">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden px-4">
                    <table class="min-w-full divide-y-8 divide-white border-separate border-spacing-y-4">
                        <thead class="bg-white sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">{{ __('Identity') }}</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px] hidden md:table-cell">{{ __('Email') }}</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">{{ __('Role') }}</th>
                                <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[2px]">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                                    <td class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-l-[1.5rem] border-y border-l border-transparent group-hover:border-blue-100 transition-all shadow-sm">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 text-gray-700 flex items-center justify-center font-black text-lg group-hover:from-blue-100 group-hover:to-blue-200 group-hover:text-cps-blue transition-all shadow-sm">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-base font-black text-gray-900 tracking-tight">{{ $user->name }}</p>
                                                <p class="text-[10px] font-bold text-gray-400 md:hidden">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-blue-100 transition-all shadow-sm hidden md:table-cell">
                                        <p class="text-sm font-medium text-gray-500">{{ $user->email }}</p>
                                    </td>
                                    <td class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-blue-100 transition-all shadow-sm">
                                        <div class="flex flex-wrap gap-1">
                                            @forelse($user->roles as $role)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-cps-blue/10 text-cps-blue border border-cps-blue/20">
                                                    {{ $role->name }}
                                                </span>
                                            @empty
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-gray-100 text-gray-400">
                                                    {{ __('No Role') }}
                                                </span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-r-[1.5rem] border-y border-r border-transparent group-hover:border-blue-100 text-right transition-all shadow-sm">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('users.edit', $user) }}" 
                                                class="p-2.5 text-cps-blue bg-white rounded-xl border border-gray-200 hover:bg-cps-blue hover:text-white hover:border-cps-blue hover:shadow-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2.5 text-red-500 bg-white rounded-xl border border-gray-200 hover:bg-red-500 hover:text-white hover:border-red-500 hover:shadow-lg transition-all">
                                                    <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-20 text-center">
                                        <div class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-dashed border-gray-200">
                                            <svg class="w-12 h-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                        </div>
                                        <h4 class="text-xl font-black text-gray-800">{{ __('No users found') }}</h4>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 px-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
