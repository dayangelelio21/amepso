<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Transaction Management
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Monitor all AMEPSO wallet transactions.
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
                        Transactions
                    </h1>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Complete wallet transaction ledger.
                    </p>

                </div>


                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                >
                    ← Admin Dashboard
                </a>

            </div>


            {{-- Filters --}}
            <div class="mb-6 flex flex-wrap gap-2">

                {{-- All --}}
                <a
                    href="{{ route('admin.transactions.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ !$type
                        ? 'bg-blue-600 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    All
                </a>


                {{-- Top Ups --}}
                <a
                    href="{{ route('admin.transactions.index', ['type' => 'top_up']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ $type === 'top_up'
                        ? 'bg-green-600 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    Top Ups
                </a>


                {{-- ORMECO --}}
                <a
                    href="{{ route('admin.transactions.index', ['type' => 'bill_payment']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ $type === 'bill_payment'
                        ? 'bg-purple-600 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    ORMECO Payments
                </a>

            </div>


            {{-- Transaction Table --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">

                @if ($transactions->count())

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50 dark:bg-gray-700/50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        User
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Type
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Amount
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Balance
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Reference
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

                                @foreach ($transactions as $transaction)

                                    @php

                                        $isCredit =
                                            $transaction->type === 'top_up';

                                    @endphp


                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">

                                        {{-- User --}}
                                        <td class="px-6 py-5">

                                            <p class="font-semibold text-gray-900 dark:text-gray-100">

                                                {{ $transaction->wallet?->user?->name ?? 'Unknown User' }}

                                            </p>

                                            <p class="text-sm text-gray-500 dark:text-gray-400">

                                                {{ $transaction->wallet?->user?->email ?? 'N/A' }}

                                            </p>

                                        </td>


                                        {{-- Type --}}
                                        <td class="px-6 py-5">

                                            @if ($transaction->type === 'top_up')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">

                                                    Top Up

                                                </span>

                                            @elseif ($transaction->type === 'bill_payment')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300">

                                                    ORMECO Payment

                                                </span>

                                            @else

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">

                                                    {{ ucfirst(str_replace('_', ' ', $transaction->type)) }}

                                                </span>

                                            @endif

                                        </td>


                                        {{-- Amount --}}
                                        <td class="px-6 py-5">

                                            <span
                                                class="font-bold
                                                {{ $isCredit
                                                    ? 'text-green-600 dark:text-green-400'
                                                    : 'text-red-600 dark:text-red-400' }}"
                                            >

                                                {{ $isCredit ? '+' : '-' }}
                                                ₱{{ number_format((float) $transaction->amount, 2) }}

                                            </span>

                                        </td>


                                        {{-- Balance --}}
                                        <td class="px-6 py-5">

                                            <div>

                                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                                    Before
                                                </p>

                                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                                    ₱{{ number_format((float) $transaction->balance_before, 2) }}
                                                </p>

                                            </div>

                                            <div class="mt-2">

                                                <p class="text-xs text-gray-400 dark:text-gray-500">
                                                    After
                                                </p>

                                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                                    ₱{{ number_format((float) $transaction->balance_after, 2) }}
                                                </p>

                                            </div>

                                        </td>


                                        {{-- Reference --}}
                                        <td class="px-6 py-5">

                                            <span class="text-xs text-gray-500 dark:text-gray-400 break-all">

                                                {{ $transaction->reference ?? 'N/A' }}

                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td class="px-6 py-5">

                                            @if ($transaction->status === 'completed')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">

                                                    Completed

                                                </span>

                                            @elseif ($transaction->status === 'pending')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300">

                                                    Pending

                                                </span>

                                            @elseif ($transaction->status === 'failed')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">

                                                    Failed

                                                </span>

                                            @else

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">

                                                    {{ ucfirst($transaction->status) }}

                                                </span>

                                            @endif

                                        </td>


                                        {{-- Date --}}
                                        <td class="px-6 py-5">

                                            <p class="text-sm text-gray-700 dark:text-gray-300">

                                                {{ $transaction->created_at?->format('M d, Y') }}

                                            </p>

                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">

                                                {{ $transaction->created_at?->format('h:i A') }}

                                            </p>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    @if ($transactions->hasPages())

                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">

                            {{ $transactions->links() }}

                        </div>

                    @endif

                @else

                    <div class="p-12 text-center">

                        <div class="text-4xl">
                            📜
                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            No transactions found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            There are no wallet transactions matching this filter.
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