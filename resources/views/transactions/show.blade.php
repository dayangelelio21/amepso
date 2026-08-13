<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                Payment Receipt
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Transaction receipt for your AMEPSO wallet activity.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            @php
                $isCredit = $transaction->type === 'top_up';

                $transactionType = match ($transaction->type) {
                    'top_up' => 'Wallet Top Up',
                    'bill_payment' => 'ORMECO Bill Payment',
                    default => ucfirst(str_replace('_', ' ', $transaction->type)),
                };
            @endphp


            {{-- Receipt --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">


                {{-- Receipt Header --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-indigo-700 text-white">

                    <div class="absolute -right-16 -top-16 w-48 h-48 rounded-full bg-white/10"></div>

                    <div class="absolute -left-20 -bottom-24 w-56 h-56 rounded-full bg-white/5"></div>


                    <div class="relative px-6 sm:px-8 py-9 text-center">

                        <div class="mx-auto w-16 h-16 rounded-2xl bg-white/15 flex items-center justify-center backdrop-blur">

                            <span class="text-2xl">
                                🧾
                            </span>

                        </div>


                        <h1 class="mt-5 text-2xl font-bold">
                            AMEPSO
                        </h1>


                        <p class="mt-1 text-sm text-blue-100">
                            Payment Receipt
                        </p>

                    </div>

                </div>


                {{-- Amount & Status --}}
                <div class="px-6 sm:px-8 pt-8 pb-7 text-center">


                    <div
                        class="mx-auto w-20 h-20 rounded-full flex items-center justify-center
                        {{ $isCredit
                            ? 'bg-green-100 dark:bg-green-900/40'
                            : 'bg-red-100 dark:bg-red-900/40' }}"
                    >

                        <span
                            class="text-4xl font-bold
                            {{ $isCredit
                                ? 'text-green-600 dark:text-green-400'
                                : 'text-red-600 dark:text-red-400' }}"
                        >
                            {{ $isCredit ? '+' : '−' }}
                        </span>

                    </div>


                    <p class="mt-5 text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ $transactionType }}
                    </p>


                    <p
                        class="mt-2 text-4xl sm:text-5xl font-bold tracking-tight
                        {{ $isCredit
                            ? 'text-green-600 dark:text-green-400'
                            : 'text-red-600 dark:text-red-400' }}"
                    >
                        {{ $isCredit ? '+' : '-' }}₱{{ number_format((float) $transaction->amount, 2) }}
                    </p>


                    {{-- Status --}}
                    <div class="mt-5">

                        @if ($transaction->status === 'completed')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">

                                <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                Completed

                            </span>


                        @elseif ($transaction->status === 'pending')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300">

                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>

                                Pending

                            </span>


                        @elseif ($transaction->status === 'failed')

                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">

                                <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                Failed

                            </span>


                        @else

                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">

                                {{ ucfirst($transaction->status) }}

                            </span>

                        @endif

                    </div>

                </div>


                {{-- Receipt Divider --}}
                <div class="px-6 sm:px-8">

                    <div class="border-t border-dashed border-gray-300 dark:border-gray-600"></div>

                </div>


                {{-- Receipt Details --}}
                <div class="px-6 sm:px-8 py-6">


                    <div class="rounded-2xl bg-gray-50 dark:bg-gray-700/40 border border-gray-100 dark:border-gray-700 overflow-hidden">


                        {{-- Transaction Type --}}
                        <div class="flex items-start justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Transaction Type
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right">
                                {{ $transactionType }}
                            </span>

                        </div>


                        {{-- Description --}}
                        <div class="flex items-start justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Description
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right max-w-xs">
                                {{ $transaction->description ?? 'Wallet transaction' }}
                            </span>

                        </div>


                        {{-- Reference --}}
                        <div class="flex items-start justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400 flex-shrink-0">
                                Reference
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right break-all">
                                {{ $transaction->reference ?? '—' }}
                            </span>

                        </div>


                        {{-- Amount --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Amount
                            </span>

                            <span class="text-sm font-bold text-gray-900 dark:text-gray-100">
                                ₱{{ number_format((float) $transaction->amount, 2) }}
                            </span>

                        </div>


                        {{-- Balance Before --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Balance Before
                            </span>

                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                ₱{{ number_format((float) $transaction->balance_before, 2) }}
                            </span>

                        </div>


                        {{-- Balance After --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                                Balance After
                            </span>

                            <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                ₱{{ number_format((float) $transaction->balance_after, 2) }}
                            </span>

                        </div>


                        {{-- Date --}}
                        <div class="flex items-start justify-between gap-5 px-5 py-4">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Date
                            </span>

                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100 text-right">
                                {{ $transaction->created_at?->format('F d, Y • h:i A') }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Status Message --}}
                <div class="px-6 sm:px-8 pb-6">


                    @if ($transaction->status === 'completed')

                        <div class="p-5 rounded-2xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900">

                            <div class="flex gap-4">

                                <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/50 flex items-center justify-center text-green-600 dark:text-green-400 flex-shrink-0">
                                    ✓
                                </div>

                                <div>

                                    <p class="text-sm font-bold text-green-800 dark:text-green-300">
                                        Payment completed successfully
                                    </p>

                                    <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                                        This transaction has been successfully recorded in your AMEPSO wallet.
                                    </p>

                                </div>

                            </div>

                        </div>


                    @elseif ($transaction->status === 'pending')

                        <div class="p-5 rounded-2xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-900">

                            <div class="flex gap-4">

                                <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center text-amber-600 dark:text-amber-400 flex-shrink-0">
                                    !
                                </div>

                                <div>

                                    <p class="text-sm font-bold text-amber-800 dark:text-amber-300">
                                        Payment is still pending
                                    </p>

                                    <p class="mt-1 text-sm text-amber-700 dark:text-amber-400">
                                        This transaction has not been completed yet.
                                    </p>

                                </div>

                            </div>

                        </div>


                    @elseif ($transaction->status === 'failed')

                        <div class="p-5 rounded-2xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900">

                            <div class="flex gap-4">

                                <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/50 flex items-center justify-center text-red-600 dark:text-red-400 flex-shrink-0">
                                    ×
                                </div>

                                <div>

                                    <p class="text-sm font-bold text-red-800 dark:text-red-300">
                                        Payment failed
                                    </p>

                                    <p class="mt-1 text-sm text-red-700 dark:text-red-400">
                                        This transaction was not completed.
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- Receipt Footer --}}
                <div class="px-6 sm:px-8">

                    <div class="pt-6 border-t border-dashed border-gray-300 dark:border-gray-600 text-center">

                        <p class="text-xs text-gray-400 dark:text-gray-500">
                            This receipt was generated by AMEPSO.
                        </p>

                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                            Keep this reference for your records.
                        </p>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="px-6 sm:px-8 pt-6 pb-8 flex flex-col sm:flex-row gap-3">

                    <a
                        href="{{ route('transactions.index') }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition"
                    >
                        ← Transaction History
                    </a>


                    <a
                        href="{{ route('dashboard') }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 py-3.5 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                    >
                        Dashboard
                    </a>

                </div>


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