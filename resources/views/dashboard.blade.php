<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                    AMEPSO
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Your digital wallet
                </p>
            </div>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Welcome --}}
            <div class="mb-8">

                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                    Dashboard
                </p>

                <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Welcome back, {{ Auth::user()->name }} 👋
                </h1>

                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Manage your wallet and electricity payments in one place.
                </p>

            </div>


            {{-- Wallet + Actions --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


                {{-- Wallet Card --}}
                <div class="lg:col-span-2 relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white shadow-lg">

                    {{-- Decorative circles --}}
                    <div class="absolute -right-16 -top-16 w-48 h-48 rounded-full bg-white/10"></div>
                    <div class="absolute -right-8 -bottom-20 w-56 h-56 rounded-full bg-white/5"></div>


                    <div class="relative p-7 sm:p-9">

                        <div class="flex items-start justify-between">

                            <div>

                                <p class="text-sm font-medium text-blue-100">
                                    Available Balance
                                </p>

                                <p class="mt-3 text-4xl sm:text-5xl font-bold tracking-tight">
                                    ₱{{ number_format((float) $wallet->balance, 2) }}
                                </p>

                                <p class="mt-3 text-sm text-blue-100">
                                    AMEPSO Wallet
                                </p>

                            </div>


                            <div class="w-12 h-12 rounded-2xl bg-white/15 backdrop-blur flex items-center justify-center">

                                <span class="text-2xl">
                                    💳
                                </span>

                            </div>

                        </div>


                        {{-- Wallet Actions --}}
                        <div class="mt-9 flex flex-col sm:flex-row gap-3">

                            <a
                                href="{{ route('topup.index') }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-white text-blue-700 font-bold rounded-xl hover:bg-blue-50 transition shadow-sm"
                            >
                                <span>＋</span>
                                Top Up Wallet
                            </a>

                            <a
                                href="{{ route('transactions.index') }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold rounded-xl transition"
                            >
                                <span>📜</span>
                                Transactions
                            </a>

                        </div>

                    </div>

                </div>


                {{-- Pay ORMECO Card --}}
                <a
                    href="{{ route('ormeco.index') }}"
                    class="group relative overflow-hidden rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg transition"
                >

                    <div class="p-7 h-full flex flex-col">

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">

                            <span class="text-2xl">
                                ⚡
                            </span>

                        </div>


                        <div class="mt-6">

                            <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                Electricity
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900 dark:text-gray-100">
                                Pay ORMECO
                            </h3>

                            <p class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">
                                View your electricity bill and pay directly using your AMEPSO wallet.
                            </p>

                        </div>


                        <div class="mt-auto pt-7 flex items-center justify-between">

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                Pay bill
                            </span>

                            <span class="text-lg text-blue-600 dark:text-blue-400 group-hover:translate-x-1 transition">
                                →
                            </span>

                        </div>

                    </div>

                </a>

            </div>


            {{-- Quick Actions --}}
            <div class="mt-8">

                <div class="mb-4">

                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        Quick Actions
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Access your most-used wallet features.
                    </p>

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">


                    {{-- Top Up --}}
                    <a
                        href="{{ route('topup.index') }}"
                        class="group bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-5 hover:shadow-md hover:-translate-y-0.5 transition"
                    >

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center">
                                💰
                            </div>

                            <div class="flex-1">

                                <h3 class="font-semibold text-gray-900 dark:text-gray-100">
                                    Top Up
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Add money to your wallet
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:translate-x-1 transition">
                                →
                            </span>

                        </div>

                    </a>


                    {{-- Transactions --}}
                    <a
                        href="{{ route('transactions.index') }}"
                        class="group bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-5 hover:shadow-md hover:-translate-y-0.5 transition"
                    >

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center">
                                📜
                            </div>

                            <div class="flex-1">

                                <h3 class="font-semibold text-gray-900 dark:text-gray-100">
                                    Transactions
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    View your wallet activity
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:translate-x-1 transition">
                                →
                            </span>

                        </div>

                    </a>


                    {{-- Top Up History --}}
                    <a
                        href="{{ route('topup.history') }}"
                        class="group bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl p-5 hover:shadow-md hover:-translate-y-0.5 transition"
                    >

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center">
                                🧾
                            </div>

                            <div class="flex-1">

                                <h3 class="font-semibold text-gray-900 dark:text-gray-100">
                                    Top Up History
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    View your payment records
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:translate-x-1 transition">
                                →
                            </span>

                        </div>

                    </a>

                </div>

            </div>


            {{-- Recent Transactions --}}
            <div class="mt-8">

                <div class="flex items-end justify-between mb-4">

                    <div>

                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                            Recent Transactions
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Your latest wallet activity.
                        </p>

                    </div>


                    <a
                        href="{{ route('transactions.index') }}"
                        class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300"
                    >
                        View all →
                    </a>

                </div>


                <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">

                    @if ($wallet->transactions->count())

                        <div class="divide-y divide-gray-100 dark:divide-gray-700">

                            @foreach ($wallet->transactions->sortByDesc('created_at')->take(5) as $transaction)

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
                                    class="block p-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition"
                                >

                                    <div class="flex items-center gap-4">


                                        {{-- Icon --}}
                                        <div
                                            class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0
                                            {{ $isCredit
                                                ? 'bg-green-100 dark:bg-green-900/40'
                                                : 'bg-red-100 dark:bg-red-900/40' }}"
                                        >

                                            <span class="text-lg">
                                                {{ $isCredit ? '＋' : '−' }}
                                            </span>

                                        </div>


                                        {{-- Information --}}
                                        <div class="flex-1 min-w-0">

                                            <div class="flex items-center gap-2">

                                                <p class="font-semibold text-gray-900 dark:text-gray-100 truncate">
                                                    {{ $transactionName }}
                                                </p>

                                                @if ($transaction->status === 'completed')

                                                    <span class="hidden sm:inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">
                                                        Completed
                                                    </span>

                                                @endif

                                            </div>


                                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate mt-1">
                                                {{ $transaction->description ?? 'Wallet transaction' }}
                                            </p>


                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                {{ $transaction->created_at?->format('M d, Y • h:i A') }}
                                            </p>

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

                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                Balance:
                                                ₱{{ number_format((float) $transaction->balance_after, 2) }}
                                            </p>

                                        </div>

                                    </div>

                                </a>

                            @endforeach

                        </div>


                    @else

                        <div class="text-center py-14 px-6">

                            <div class="w-14 h-14 mx-auto rounded-2xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                                📄
                            </div>

                            <h3 class="mt-4 font-semibold text-gray-900 dark:text-gray-100">
                                No transactions yet
                            </h3>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Your wallet activity will appear here.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Footer Note --}}
            <div class="mt-8 text-center">

                <p class="text-xs text-gray-400 dark:text-gray-500">
                    AMEPSO • Secure digital wallet and electricity payments
                </p>

            </div>

        </div>

    </div>

</x-app-layout>