<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                User Details
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                View AMEPSO user account and wallet information.
            </p>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Back --}}
            <div class="mb-6">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                >
                    ← Back to Users
                </a>

            </div>


            {{-- User Header --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6 sm:p-8">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

                    <div class="flex items-center gap-4">

                        <div class="w-16 h-16 rounded-2xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">

                            <span class="text-2xl">
                                👤
                            </span>

                        </div>


                        <div>

                            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $user->name }}
                            </h1>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ $user->email }}
                            </p>

                        </div>

                    </div>


                    {{-- Role --}}
                    <div>

                        @if ($user->role === 'admin')

                            <span class="inline-flex px-3 py-1.5 rounded-full text-xs font-semibold bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300">
                                Administrator
                            </span>

                        @else

                            <span class="inline-flex px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300">
                                User
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Account + Wallet --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">


                {{-- Account Information --}}
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-6">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        Account Information
                    </h3>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Basic account details.
                    </p>


                    <div class="mt-6 space-y-4">

                        <div class="flex justify-between gap-4 py-3 border-b border-gray-200 dark:border-gray-700">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                User ID
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                #{{ $user->id }}
                            </span>

                        </div>


                        <div class="flex justify-between gap-4 py-3 border-b border-gray-200 dark:border-gray-700">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Name
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right">
                                {{ $user->name }}
                            </span>

                        </div>


                        <div class="flex justify-between gap-4 py-3 border-b border-gray-200 dark:border-gray-700">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Email
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right break-all">
                                {{ $user->email }}
                            </span>

                        </div>


                        <div class="flex justify-between gap-4 py-3 border-b border-gray-200 dark:border-gray-700">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Role
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ ucfirst($user->role) }}
                            </span>

                        </div>


                        <div class="flex justify-between gap-4 py-3">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Registered
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ $user->created_at?->format('M d, Y h:i A') }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Wallet --}}
                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white overflow-hidden relative">

                    <div class="relative z-10">

                        <p class="text-sm text-blue-100">
                            AMEPSO Wallet
                        </p>

                        <p class="mt-2 text-4xl font-bold">
                            ₱{{ number_format((float) ($user->wallet?->balance ?? 0), 2) }}
                        </p>

                        <p class="mt-2 text-sm text-blue-100">
                            Current available balance
                        </p>


                        @if ($user->wallet)

                            <div class="mt-6 pt-5 border-t border-white/20">

                                <div class="flex justify-between text-sm">

                                    <span class="text-blue-100">
                                        Wallet ID
                                    </span>

                                    <span class="font-semibold">
                                        #{{ $user->wallet->id }}
                                    </span>

                                </div>

                                <div class="flex justify-between text-sm mt-3">

                                    <span class="text-blue-100">
                                        Created
                                    </span>

                                    <span class="font-semibold">
                                        {{ $user->wallet->created_at?->format('M d, Y') }}
                                    </span>

                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- Decorative circles --}}
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>

                    <div class="absolute -right-16 bottom-[-70px] w-52 h-52 bg-white/10 rounded-full"></div>

                </div>

            </div>


            {{-- Recent Top Ups --}}
            <div class="mt-8">

                <div class="mb-4">

                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        Recent Top Ups
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Latest wallet funding activity from this user.
                    </p>

                </div>


                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">

                    @if ($user->topUps->count())

                        <div class="divide-y divide-gray-200 dark:divide-gray-700">

                            @foreach ($user->topUps->take(5) as $topUp)

                                <div class="p-5">

                                    <div class="flex items-center justify-between gap-4">

                                        <div>

                                            <p class="font-semibold text-gray-900 dark:text-gray-100">
                                                Wallet Top Up
                                            </p>

                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                {{ $topUp->created_at?->format('M d, Y • h:i A') }}
                                            </p>

                                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500 break-all">
                                                {{ $topUp->reference }}
                                            </p>

                                        </div>


                                        <div class="text-right">

                                            <p class="font-bold text-green-600 dark:text-green-400">
                                                +₱{{ number_format((float) $topUp->amount, 2) }}
                                            </p>

                                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">
                                                {{ ucfirst($topUp->status) }}
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="p-10 text-center">

                            <div class="text-3xl">
                                💳
                            </div>

                            <p class="mt-3 font-semibold text-gray-900 dark:text-gray-100">
                                No top ups yet
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Recent Transactions --}}
            <div class="mt-8">

                <div class="mb-4">

                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        Recent Transactions
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Latest wallet activity from this user.
                    </p>

                </div>


                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">

                    @if ($user->wallet && $user->wallet->transactions->count())

                        <div class="divide-y divide-gray-200 dark:divide-gray-700">

                            @foreach ($user->wallet->transactions->take(8) as $transaction)

                                @php
                                    $isCredit = $transaction->type === 'top_up';
                                @endphp

                                <div class="p-5">

                                    <div class="flex items-center justify-between gap-4">

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

                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $transaction->description ?? 'Wallet transaction' }}
                                                </p>

                                                <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                                    {{ $transaction->created_at?->format('M d, Y • h:i A') }}
                                                </p>

                                            </div>

                                        </div>


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

                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                Balance:
                                                ₱{{ number_format((float) $transaction->balance_after, 2) }}
                                            </p>

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

                        </div>

                    @endif

                </div>

            </div>


            {{-- Back --}}
            <div class="mt-8">

                <a
                    href="{{ route('admin.users.index') }}"
                    class="inline-flex px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition"
                >
                    ← Back to Users
                </a>

            </div>

        </div>

    </div>

</x-app-layout>