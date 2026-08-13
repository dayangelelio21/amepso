<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                AMEPSO Admin Dashboard
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Manage and monitor the AMEPSO digital wallet system.
            </p>
        </div>
    </x-slot>


    {{-- Main Content --}}
    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- Welcome --}}
            <div class="mb-8">

                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                    Administration
                </p>

                <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Welcome, Administrator 👋
                </h1>

                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Here's an overview of your AMEPSO system.
                </p>

            </div>


            {{-- ========================================================= --}}
            {{-- STATISTICS --}}
            {{-- ========================================================= --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">


                {{-- Total Users --}}
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm"
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total Users
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                                {{ number_format($totalUsers) }}
                            </p>

                        </div>

                        <div
                            class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center"
                        >
                            <span class="text-xl">👥</span>
                        </div>

                    </div>

                </div>


                {{-- Total Wallet Balance --}}
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm"
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total Wallet Balance
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                ₱{{ number_format((float) $totalWalletBalance, 2) }}
                            </p>

                        </div>

                        <div
                            class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center"
                        >
                            <span class="text-xl">💰</span>
                        </div>

                    </div>

                </div>


                {{-- Completed Top Ups --}}
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm"
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Completed Top Ups
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                ₱{{ number_format((float) $totalTopUpAmount, 2) }}
                            </p>

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ number_format($totalTopUps) }} total records
                            </p>

                        </div>

                        <div
                            class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center"
                        >
                            <span class="text-xl">💳</span>
                        </div>

                    </div>

                </div>


                {{-- Transactions --}}
                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm"
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Transactions
                            </p>

                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                                {{ number_format($totalTransactions) }}
                            </p>

                        </div>

                        <div
                            class="w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center"
                        >
                            <span class="text-xl">📜</span>
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- ORMECO OVERVIEW --}}
            {{-- ========================================================= --}}

            <div class="mt-8">

                <div class="mb-4">

                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        ORMECO Overview
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Electricity bill payment statistics.
                    </p>

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">


                    {{-- Total Bills --}}
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm"
                    >

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Total Bills
                        </p>

                        <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-gray-100">
                            {{ number_format($totalOrmecoBills) }}
                        </p>

                    </div>


                    {{-- Paid Bills --}}
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm"
                    >

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Paid Bills
                        </p>

                        <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">
                            {{ number_format($paidOrmecoBills) }}
                        </p>

                    </div>


                    {{-- Unpaid Bills --}}
                    <div
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm"
                    >

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Unpaid Bills
                        </p>

                        <p class="mt-2 text-3xl font-bold text-yellow-600 dark:text-yellow-400">
                            {{ number_format($unpaidOrmecoBills) }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- RECENT TRANSACTIONS --}}
            {{-- ========================================================= --}}

            <div class="mt-8">

                <div class="flex items-center justify-between mb-4">

                    <div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                            Recent Transactions
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Latest wallet activity.
                        </p>

                    </div>

                </div>


                <div
                    class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden shadow-sm"
                >

                    @if ($recentTransactions->count())

                        <div class="divide-y divide-gray-200 dark:divide-gray-700">

                            @foreach ($recentTransactions as $transaction)

                                @php
                                    $isCredit = $transaction->type === 'top_up';
                                @endphp


                                <div class="p-5">

                                    <div class="flex items-center justify-between gap-4">


                                        {{-- Transaction Information --}}
                                        <div class="flex items-center gap-4 min-w-0">

                                            <div
                                                class="w-11 h-11 rounded-xl flex items-center justify-center
                                                {{ $isCredit
                                                    ? 'bg-green-100 dark:bg-green-900/40'
                                                    : 'bg-red-100 dark:bg-red-900/40' }}"
                                            >

                                                <span>
                                                    {{ $isCredit ? '＋' : '−' }}
                                                </span>

                                            </div>


                                            <div class="min-w-0">

                                                <p class="font-semibold text-gray-900 dark:text-gray-100">

                                                    @if ($transaction->type === 'top_up')

                                                        Wallet Top Up

                                                    @elseif ($transaction->type === 'bill_payment')

                                                        ORMECO Bill Payment

                                                    @else

                                                        {{ ucfirst(str_replace('_', ' ', $transaction->type)) }}

                                                    @endif

                                                </p>


                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $transaction->description ?? 'Wallet transaction' }}
                                                </p>


                                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                    {{ $transaction->created_at?->format('M d, Y • h:i A') }}
                                                </p>

                                            </div>

                                        </div>


                                        {{-- Amount --}}
                                        <div class="text-right flex-shrink-0">

                                            <p
                                                class="font-bold
                                                {{ $isCredit
                                                    ? 'text-green-600 dark:text-green-400'
                                                    : 'text-red-600 dark:text-red-400' }}"
                                            >

                                                {{ $isCredit ? '+' : '-' }}
                                                ₱{{ number_format((float) $transaction->amount, 2) }}

                                            </p>


                                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ ucfirst($transaction->status) }}
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="p-10 text-center">

                            <div class="text-3xl">
                                📜
                            </div>

                            <p class="mt-3 font-semibold text-gray-900 dark:text-gray-100">
                                No transactions yet
                            </p>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Wallet activity will appear here.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- ADMIN ACTIONS --}}
            {{-- ========================================================= --}}

            <div class="mt-8">

                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                    Admin Actions
                </h3>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 mb-4">
                    Manage the AMEPSO system.
                </p>


                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">


                    {{-- User Management --}}
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-blue-400 dark:hover:border-blue-500 transition cursor-pointer"
                    >

                        <div
                            class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center"
                        >
                            👥
                        </div>

                        <h4 class="mt-4 font-semibold text-gray-900 dark:text-gray-100">
                            User Management
                        </h4>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            View and manage AMEPSO users.
                        </p>

                    </a>


                    {{-- Top Ups --}}
                    <a
                        href="{{ route('admin.topups.index') }}"
                        class="block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-green-400 dark:hover:border-green-500 transition cursor-pointer"
                    >

                        <div
                            class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center"
                        >
                            💰
                        </div>

                        <h4 class="mt-4 font-semibold text-gray-900 dark:text-gray-100">
                            Wallet Monitoring
                        </h4>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Monitor wallet balances and top ups.
                        </p>

                    </a>


                    {{-- Transactions --}}
                    <a
                        href="{{ route('admin.transactions.index') }}"
                        class="block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-orange-400 dark:hover:border-orange-500 transition cursor-pointer"
                    >

                        <div
                            class="w-11 h-11 rounded-xl bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center"
                        >
                            📜
                        </div>

                        <h4 class="mt-4 font-semibold text-gray-900 dark:text-gray-100">
                            Transactions
                        </h4>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            View wallet transaction history.
                        </p>

                    </a>


                    {{-- ORMECO --}}
                    <a
                        href="{{ route('admin.ormeco.index') }}"
                        class="block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-purple-400 dark:hover:border-purple-500 transition cursor-pointer"
                    >

                        <div
                            class="w-11 h-11 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center"
                        >
                            ⚡
                        </div>

                        <h4 class="mt-4 font-semibold text-gray-900 dark:text-gray-100">
                            ORMECO
                        </h4>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage ORMECO accounts and information.
                        </p>

                    </a>


                    {{-- ORMECO Bills --}}
                    <a
                        href="{{ route('admin.ormeco-bills.index') }}"
                        class="block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-yellow-400 dark:hover:border-yellow-500 transition cursor-pointer"
                    >

                        <div
                            class="w-11 h-11 rounded-xl bg-yellow-100 dark:bg-yellow-900/40 flex items-center justify-center"
                        >
                            🧾
                        </div>

                        <h4 class="mt-4 font-semibold text-gray-900 dark:text-gray-100">
                            ORMECO Bills
                        </h4>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            View and manage electricity bills.
                        </p>

                    </a>


                    {{-- Create ORMECO Bill --}}
                    <a
                        href="{{ route('admin.ormeco-bills.create') }}"
                        class="block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-red-400 dark:hover:border-red-500 transition cursor-pointer"
                    >

                        <div
                            class="w-11 h-11 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center"
                        >
                            ➕
                        </div>

                        <h4 class="mt-4 font-semibold text-gray-900 dark:text-gray-100">
                            Create ORMECO Bill
                        </h4>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Add a new electricity bill.
                        </p>

                    </a>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>