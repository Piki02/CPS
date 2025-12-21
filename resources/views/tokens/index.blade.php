<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Store Access Tokens') }}
                </h2>
                <p class="text-sm font-medium text-gray-500 mt-1">
                    {{ __('Manage temporary secure access for vessel captains and visitors.') }}</p>
            </div>
            <div class="hidden md:block">
                <span
                    class="inline-flex items-center px-4 py-2 rounded-2xl bg-white border border-gray-100 shadow-sm text-xs font-bold text-gray-400 uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    {{ __('Security Active') }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- Generate Token Card -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 transition-all group-hover:bg-blue-100 duration-500">
                </div>

                <div class="relative flex flex-col lg:flex-row items-start justify-between gap-10">
                    <div class="max-w-md">
                        <div
                            class="inline-flex items-center gap-2 bg-blue-50 text-cps-blue px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest mb-4">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            {{ __('Secure Generation') }}
                        </div>
                        <h3 class="text-3xl font-black text-gray-800 mb-4 tracking-tight leading-tight">
                            {{ __('Create Access Pass') }}</h3>
                        <p class="text-gray-500 text-base font-medium leading-relaxed">
                            {{ __('Generate a unique temporary token. This allows captains to access the store catalog securely without a permanent account.') }}
                        </p>
                    </div>

                    <form action="{{ route('tokens.generate') }}" method="POST"
                        class="w-full lg:flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/50 p-6 md:p-8 rounded-[2rem] border border-gray-100 shadow-inner">
                        @csrf
                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">{{ __('Captain Name') }}</label>
                            <input type="text" name="captain_name" required placeholder="{{ __('Enter full name...') }}"
                                class="block w-full px-4 py-3.5 bg-white border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-cps-blue transition-all font-medium text-gray-700 shadow-sm">
                        </div>

                        <div class="space-y-2">
                            <label
                                class="block text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">{{ __('Vessel Name') }}</label>
                            <input type="text" name="vessel_name" placeholder="{{ __('Enter vessel name...') }}"
                                class="block w-full px-4 py-3.5 bg-white border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-cps-blue transition-all font-medium text-gray-700 shadow-sm">
                        </div>

                        <div class="md:col-span-2 mt-2">
                            <button type="submit"
                                class="w-full bg-gray-900 text-white font-black py-4 px-8 rounded-2xl hover:bg-black transition-all shadow-xl shadow-gray-900/10 active:scale-[0.98] flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                {{ __('Generate Secure Token') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tokens Tables -->
            <div class="grid grid-cols-1 gap-12">

                <!-- Active Tokens -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 px-2">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <h4 class="text-xl font-black text-gray-800 tracking-tight">{{ __('Live Sessions') }}</h4>
                        <span
                            class="ml-auto text-[10px] font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full uppercase tracking-widest">
                            {{ $tokens->where('is_active', true)->count() }} {{ __('Active') }}
                        </span>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden px-4">
                        <table class="min-w-full divide-y-8 divide-white border-separate border-spacing-y-4">
                            <thead class="bg-white sticky top-0 z-10">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                        {{ __('Access Token') }}</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                        {{ __('Captain / Vessel') }}</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px] hidden md:table-cell">
                                        {{ __('Created') }}</th>
                                    <th
                                        class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                        {{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tokens->where('is_active', true) as $token)
                                    <tr class="group hover:bg-emerald-50/30 transition-all duration-300">
                                        <td
                                            class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-l-[1.5rem] border-y border-l border-transparent group-hover:border-emerald-100 transition-all shadow-sm">
                                            <div class="flex items-center gap-3">
                                                <div class="p-2.5 bg-emerald-100 text-emerald-600 rounded-xl">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                    </svg>
                                                </div>
                                                <code
                                                    class="text-sm font-black text-emerald-700 tracking-wider bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-100">{{ $token->token }}</code>
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-emerald-100 transition-all shadow-sm">
                                            <div>
                                                <p class="text-base font-black text-gray-900 tracking-tight">
                                                    {{ $token->captain_name }}</p>
                                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                                    {{ $token->vessel_name ?? 'Universal' }}</p>
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-emerald-100 transition-all shadow-sm hidden md:table-cell">
                                            <p class="text-xs font-bold text-gray-500">
                                                {{ $token->created_at->diffForHumans() }}</p>
                                        </td>
                                        <td
                                            class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-r-[1.5rem] border-y border-r border-transparent group-hover:border-emerald-100 text-right transition-all shadow-sm">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-500 text-white shadow-lg shadow-emerald-500/20">
                                                {{ __('Active') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-16 text-center">
                                            <p class="text-gray-400 font-bold italic">
                                                {{ __('No active access passes at the moment.') }}</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Inactive Tokens -->
                <div class="space-y-6 opacity-80 filter grayscale-[0.5] hover:grayscale-0 transition-all duration-500">
                    <div class="flex items-center gap-3 px-2">
                        <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                        <h4 class="text-xl font-black text-gray-400 tracking-tight">{{ __('Expired Passes') }}</h4>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden px-4">
                        <table class="min-w-full divide-y-8 divide-white border-separate border-spacing-y-4">
                            <thead class="bg-white sticky top-0 z-10">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                        {{ __('Access Token') }}</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                        {{ __('Captain / Vessel') }}</th>
                                    <th
                                        class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[2px] hidden md:table-cell">
                                        {{ __('Created') }}</th>
                                    <th
                                        class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[2px]">
                                        {{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tokens->where('is_active', false) as $token)
                                    <tr class="group hover:bg-gray-50 transition-all duration-300">
                                        <td
                                            class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-l-[1.5rem] border-y border-l border-transparent group-hover:border-gray-200 transition-all shadow-sm">
                                            <code
                                                class="text-xs font-bold text-gray-400 tracking-wider bg-white px-3 py-1 rounded-lg border border-gray-100">{{ $token->token }}</code>
                                        </td>
                                        <td
                                            class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-gray-200 transition-all shadow-sm">
                                            <div>
                                                <p class="text-sm font-bold text-gray-500 tracking-tight">
                                                    {{ $token->captain_name }}</p>
                                                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest">
                                                    {{ $token->vessel_name ?? 'N/A' }}</p>
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-5 bg-gray-50 group-hover:bg-white border-y border-transparent group-hover:border-gray-200 transition-all shadow-sm hidden md:table-cell">
                                            <p class="text-[10px] font-medium text-gray-400">
                                                {{ $token->created_at->toFormattedDateString() }}</p>
                                        </td>
                                        <td
                                            class="px-6 py-5 bg-gray-50 group-hover:bg-white rounded-r-[1.5rem] border-y border-r border-transparent group-hover:border-gray-200 text-right transition-all shadow-sm">
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-gray-100 text-gray-400 border border-gray-200">
                                                {{ __('Inactive') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-gray-300 text-sm font-medium">
                                            {{ __('Clear history.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>