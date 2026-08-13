<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                Transaction History
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                View all your AMEPSO wallet activity.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Page Header --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

                <div>

                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                        Wallet
                    </p>

                    <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        Transactions
                    </h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        Keep track of your wallet activity and payments.
                    </p>

                </div>


                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition"
                >
                    ← Dashboard
                </a>

            </div>


            {{-- Summary --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">


                {{-- Total Records --}}
                <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Transactions
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $transactions->total() }}
                            </p>

                        </div>

                        <div class="w-11 h-11 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center">
                            📜
                        </div>

                    </div>

                </div>


                {{-- Current Page --}}
                <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Current Page
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $transactions->currentPage() }}
                            </p>

                        </div>

                        <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                            📄
                        </div>

                    </div>

                </div>


                {{-- Wallet --}}
                <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-5 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                Wallet
                            </p>

                            <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                Active
                            </p>

                        </div>

                        <div class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center">
                            💰
                        </div>

                    </div>

                </div>

            </div>


            {{-- Transaction List --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">


                @if ($transactions->count())


                    {{-- List Header --}}
                    <div class="px-6 sm:px-7 py-5 border-b border-gray-100 dark:border-gray-700">

                        <div class="flex items-center justify-between">

                            <div>

                                <h2 class="font-bold text-gray-900 dark:text-gray-100">
                                    Wallet Activity
                                </h2>

                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Click a transaction to view its receipt.
                                </p>

                            </div>


                            <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                                💳
                            </div>

                        </div>

                    </div>


                    {{-- Transactions --}}
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">


                        @foreach ($transactions as $transaction)


                            @php
                                $isCredit = $transaction->type === 'top_up';

                                $transactionName = match ($transaction->type) {
                                    'top_up' => 'Wallet Top Up',
                                    'bill_payment' => 'ORMECO Bill Payment',
                                    default => ucfirst(str_replace('_', ' ', $transaction->type)),
                                };
                            @endphp


                            <a
                                href="{{ route('transactions.show', $transaction) }}"
                                class="group block p-5 sm:p-6 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition"
                            >

                                <div class="flex items-center gap-4">


                                    {{-- Transaction Icon --}}
                                    <div
                                        class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0
                                        {{ $isCredit
                                            ? 'bg-green-100 dark:bg-green-900/40'
                                            : 'bg-red-100 dark:bg-red-900/40' }}"
                                    >

                                        <span
                                            class="text-xl font-bold
                                            {{ $isCredit
                                                ? 'text-green-600 dark:text-green-400'
                                                : 'text-red-600 dark:text-red-400' }}"
                                        >
                                            {{ $isCredit ? '+' : '−' }}
                                        </span>

                                    </div>


                                    {{-- Details --}}
                                    <div class="flex-1 min-w-0">


                                        <div class="flex flex-wrap items-center gap-2">

                                            <h3 class="font-bold text-gray-900 dark:text-gray-100">
                                                {{ $transactionName }}
                                            </h3>


                                            {{-- Status --}}
                                            @if ($transaction->status === 'completed')

                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                                    Completed

                                                </span>


                                            @elseif ($transaction->status === 'pending')

                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                                    Pending

                                                </span>


                                            @elseif ($transaction->status === 'failed')

                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                                    Failed

                                                </span>


                                            @else

                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                    {{ ucfirst($transaction->status) }}
                                                </span>

                                            @endif

                                        </div>


                                        {{-- Description --}}
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 truncate">
                                            {{ $transaction->description ?? 'Wallet transaction' }}
                                        </p>


                                        {{-- Reference --}}
                                        @if ($transaction->reference)

                                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500 truncate">
                                                {{ $transaction->reference }}
                                            </p>

                                        @endif


                                        {{-- Date --}}
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                            {{ $transaction->created_at?->format('M d, Y • h:i A') }}
                                        </p>

                                    </div>


                                    {{-- Amount --}}
                                    <div class="text-right flex-shrink-0">


                                        <p
                                            class="text-lg sm:text-xl font-bold
                                            {{ $isCredit
                                                ? 'text-green-600 dark:text-green-400'
                                                : 'text-red-600 dark:text-red-400' }}"
                                        >

                                            {{ $isCredit ? '+' : '-' }}₱{{ number_format((float) $transaction->amount, 2) }}

                                        </p>


                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            Balance
                                            ₱{{ number_format((float) $transaction->balance_after, 2) }}
                                        </p>


                                        <p class="hidden sm:block mt-1 text-xs text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition">
                                            View receipt →
                                        </p>

                                    </div>


                                </div>

                            </a>


                        @endforeach


                    </div>


                    {{-- Pagination --}}
                    @if ($transactions->hasPages())

                        <div class="px-5 sm:px-7 py-5 border-t border-gray-100 dark:border-gray-700">

                            {{ $transactions->links() }}

                        </div>

                    @endif


                @else


                    {{-- Empty State --}}
                    <div class="px-6 py-16 text-center">


                        <div class="mx-auto w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center">

                            <span class="text-2xl">
                                📜
                            </span>

                        </div>


                        <h3 class="mt-5 text-xl font-bold text-gray-900 dark:text-gray-100">
                            No transactions yet
                        </h3>


                        <p class="mt-2 max-w-sm mx-auto text-sm leading-6 text-gray-500 dark:text-gray-400">
                            Your wallet activity will appear here after you make a top-up or payment.
                        </p>


                        <a
                            href="{{ route('topup.index') }}"
                            class="inline-flex items-center gap-2 mt-7 px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition"
                        >
                            <span>＋</span>
                            Top Up Wallet
                        </a>

                    </div>


                @endif


            </div>


            {{-- Footer --}}
            <div class="mt-8 text-center">

                <p class="text-xs text-gray-400 dark:text-gray-500">
                    AMEPSO • Secure digital wallet and electricity payments
                </p>

            </div>


        </div>

    </div>

</x-app-layout>