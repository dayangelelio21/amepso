<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Top-Up Management
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Monitor AMEPSO wallet top-up activity.
            </p>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                        Administration
                    </p>

                    <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        Top-Ups
                    </h1>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Monitor wallet funding and PayMongo payment status.
                    </p>

                </div>


                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                >
                    ← Admin Dashboard
                </a>

            </div>


            {{-- Status Filters --}}
            <div class="mb-6 flex flex-wrap gap-2">

                <a
                    href="{{ route('admin.topups.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ !$status
                        ? 'bg-blue-600 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    All
                </a>


                <a
                    href="{{ route('admin.topups.index', ['status' => 'completed']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ $status === 'completed'
                        ? 'bg-green-600 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    Completed
                </a>


                <a
                    href="{{ route('admin.topups.index', ['status' => 'pending']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ $status === 'pending'
                        ? 'bg-yellow-500 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    Pending
                </a>


                <a
                    href="{{ route('admin.topups.index', ['status' => 'failed']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ $status === 'failed'
                        ? 'bg-red-600 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    Failed
                </a>

            </div>


            {{-- Top-Up Table --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">

                @if ($topUps->count())

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50 dark:bg-gray-700/50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        User
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Amount
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Reference
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Provider
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Date
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                                @foreach ($topUps as $topUp)

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">

                                        {{-- User --}}
                                        <td class="px-6 py-5">

                                            <p class="font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $topUp->user?->name ?? 'Unknown User' }}
                                            </p>

                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $topUp->user?->email ?? 'N/A' }}
                                            </p>

                                        </td>


                                        {{-- Amount --}}
                                        <td class="px-6 py-5">

                                            <span class="font-bold text-green-600 dark:text-green-400">
                                                +₱{{ number_format((float) $topUp->amount, 2) }}
                                            </span>

                                        </td>


                                        {{-- Reference --}}
                                        <td class="px-6 py-5">

                                            <span class="text-xs text-gray-500 dark:text-gray-400 break-all">
                                                {{ $topUp->reference }}
                                            </span>

                                            @if ($topUp->provider_reference)

                                                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500 break-all">
                                                    {{ $topUp->provider_reference }}
                                                </p>

                                            @endif

                                        </td>


                                        {{-- Provider --}}
                                        <td class="px-6 py-5">

                                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                                {{ $topUp->provider
                                                    ? ucfirst($topUp->provider)
                                                    : 'Wallet' }}
                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td class="px-6 py-5">

                                            @if ($topUp->status === 'completed')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">
                                                    Completed
                                                </span>

                                            @elseif ($topUp->status === 'pending')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300">
                                                    Pending
                                                </span>

                                            @elseif ($topUp->status === 'failed')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">
                                                    Failed
                                                </span>

                                            @else

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                    {{ ucfirst($topUp->status) }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Date --}}
                                        <td class="px-6 py-5">

                                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                                {{ $topUp->created_at?->format('M d, Y') }}
                                            </p>

                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                {{ $topUp->created_at?->format('h:i A') }}
                                            </p>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    @if ($topUps->hasPages())

                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">

                            {{ $topUps->links() }}

                        </div>

                    @endif

                @else

                    {{-- Empty State --}}
                    <div class="p-12 text-center">

                        <div class="text-4xl">
                            💳
                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            No top-ups found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            There are no top-up records matching this filter.
                        </p>

                    </div>

                @endif

            </div>


            {{-- Back --}}
            <div class="mt-6">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                >
                    ← Back to Admin Dashboard
                </a>

            </div>

        </div>

    </div>

</x-app-layout>