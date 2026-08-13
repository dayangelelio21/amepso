<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Top Up Details
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                View your wallet top-up payment details.
            </p>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))

                <div class="mb-6 p-4 rounded-xl bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">
                    {{ session('success') }}
                </div>

            @endif

            {{-- Error Message --}}
            @if (session('error'))

                <div class="mb-6 p-4 rounded-xl bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">
                    {{ session('error') }}
                </div>

            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl overflow-hidden">

                <div class="p-6 sm:p-8">

                    {{-- Status --}}
                    <div class="text-center">

                        @if ($topUp->status === 'completed')

                            <div class="mx-auto w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/40 flex items-center justify-center">
                                <span class="text-3xl text-green-600 dark:text-green-400">
                                    ✓
                                </span>
                            </div>

                            <h3 class="mt-4 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                Top Up Successful
                            </h3>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Your wallet has been credited successfully.
                            </p>

                        @elseif ($topUp->status === 'pending')

                            <div class="mx-auto w-16 h-16 rounded-full bg-yellow-100 dark:bg-yellow-900/40 flex items-center justify-center">
                                <span class="text-3xl text-yellow-600 dark:text-yellow-400">
                                    ₱
                                </span>
                            </div>

                            <h3 class="mt-4 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                Payment Pending
                            </h3>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                Your payment is waiting for confirmation.
                            </p>

                        @else

                            <div class="mx-auto w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/40 flex items-center justify-center">
                                <span class="text-3xl text-red-600 dark:text-red-400">
                                    !
                                </span>
                            </div>

                            <h3 class="mt-4 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                Top Up {{ ucfirst($topUp->status) }}
                            </h3>

                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                This top-up was not completed.
                            </p>

                        @endif

                    </div>

                    {{-- Payment Details --}}
                    <div class="mt-8 border-t border-b border-gray-200 dark:border-gray-700">

                        {{-- Amount --}}
                        <div class="flex justify-between items-center py-4 border-b border-gray-200 dark:border-gray-700">

                            <span class="text-gray-500 dark:text-gray-400">
                                Amount
                            </span>

                            <span class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                ₱{{ number_format((float) $topUp->amount, 2) }}
                            </span>

                        </div>

                        {{-- Reference --}}
                        <div class="py-4 border-b border-gray-200 dark:border-gray-700">

                            <div class="flex justify-between gap-4">

                                <span class="text-gray-500 dark:text-gray-400">
                                    Reference
                                </span>

                                <span class="font-medium text-gray-900 dark:text-gray-100 text-right break-all">
                                    {{ $topUp->reference }}
                                </span>

                            </div>

                        </div>

                        {{-- Provider --}}
                        <div class="flex justify-between py-4 border-b border-gray-200 dark:border-gray-700">

                            <span class="text-gray-500 dark:text-gray-400">
                                Payment Provider
                            </span>

                            <span class="font-medium text-gray-900 dark:text-gray-100">
                                {{ $topUp->provider ? ucfirst($topUp->provider) : '—' }}
                            </span>

                        </div>

                        {{-- Status --}}
                        <div class="flex justify-between items-center py-4 border-b border-gray-200 dark:border-gray-700">

                            <span class="text-gray-500 dark:text-gray-400">
                                Status
                            </span>

                            @if ($topUp->status === 'completed')

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">
                                    Completed
                                </span>

                            @elseif ($topUp->status === 'pending')

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300">
                                    Pending
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">
                                    {{ ucfirst($topUp->status) }}
                                </span>

                            @endif

                        </div>

                        {{-- Created --}}
                        <div class="flex justify-between py-4 border-b border-gray-200 dark:border-gray-700">

                            <span class="text-gray-500 dark:text-gray-400">
                                Created
                            </span>

                            <span class="text-sm text-gray-900 dark:text-gray-100">
                                {{ $topUp->created_at?->format('M d, Y h:i A') }}
                            </span>

                        </div>

                        {{-- Paid At --}}
                        @if ($topUp->paid_at)

                            <div class="flex justify-between py-4 border-b border-gray-200 dark:border-gray-700">

                                <span class="text-gray-500 dark:text-gray-400">
                                    Paid At
                                </span>

                                <span class="text-sm text-gray-900 dark:text-gray-100">
                                    {{ $topUp->paid_at->format('M d, Y h:i A') }}
                                </span>

                            </div>

                        @endif

                        {{-- Credited At --}}
                        @if ($topUp->credited_at)

                            <div class="flex justify-between py-4">

                                <span class="text-gray-500 dark:text-gray-400">
                                    Wallet Credited
                                </span>

                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ $topUp->credited_at->format('M d, Y h:i A') }}
                                </span>

                            </div>

                        @endif

                    </div>

                    {{-- Completed Message --}}
                    @if ($topUp->status === 'completed')

                        <div class="mt-6 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900">

                            <p class="text-sm font-semibold text-green-800 dark:text-green-300">
                                Money added successfully
                            </p>

                            <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                                ₱{{ number_format((float) $topUp->amount, 2) }}
                                has been credited to your AMEPSO wallet.
                            </p>

                        </div>

                    @elseif ($topUp->status === 'pending')

                        <div class="mt-6 p-4 rounded-xl bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-900">

                            <p class="text-sm font-semibold text-yellow-800 dark:text-yellow-300">
                                Payment confirmation pending
                            </p>

                            <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                                Your wallet will only be credited after PayMongo confirms the payment.
                            </p>

                        </div>

                    @endif

                    {{-- Actions --}}
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">

                        <a
                            href="{{ route('topup.index') }}"
                            class="flex-1 text-center py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition"
                        >
                            Top Up Again
                        </a>

                        <a
                            href="{{ route('dashboard') }}"
                            class="flex-1 text-center py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                        >
                            Dashboard
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>