<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                Top Up History
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                View your previous AMEPSO wallet top-ups.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Page Heading --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5">

                <div>

                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                        Wallet
                    </p>

                    <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        Top Up History
                    </h1>

                    <p class="mt-2 text-gray-500 dark:text-gray-400">
                        Keep track of every amount added to your wallet.
                    </p>

                </div>


                <a
                    href="{{ route('topup.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-sm hover:shadow transition"
                >
                    <span>＋</span>
                    Top Up Wallet
                </a>

            </div>


            {{-- History Card --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">


                @if ($topUps->count() > 0)


                    {{-- Card Header --}}
                    <div class="px-6 sm:px-7 py-5 border-b border-gray-100 dark:border-gray-700">

                        <div class="flex items-center justify-between">

                            <div>

                                <h2 class="font-bold text-gray-900 dark:text-gray-100">
                                    Your top-ups
                                </h2>

                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    {{ $topUps->total() }} {{ $topUps->total() === 1 ? 'record' : 'records' }}
                                </p>

                            </div>


                            <div class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center">

                                <span class="text-lg">
                                    💰
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- Records --}}
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">


                        @foreach ($topUps as $topUp)


                            <a
                                href="{{ route('topup.show', $topUp) }}"
                                class="group block p-5 sm:p-6 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition"
                            >

                                <div class="flex items-center gap-4">


                                    {{-- Icon --}}
                                    <div class="w-12 h-12 rounded-2xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center flex-shrink-0">

                                        <span class="text-xl text-green-600 dark:text-green-400">
                                            ₱
                                        </span>

                                    </div>


                                    {{-- Main Details --}}
                                    <div class="flex-1 min-w-0">


                                        <div class="flex flex-wrap items-center gap-2">

                                            <h3 class="font-bold text-gray-900 dark:text-gray-100">
                                                Wallet Top Up
                                            </h3>


                                            {{-- Status --}}
                                            @if ($topUp->status === 'completed')

                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                                    Completed

                                                </span>


                                            @elseif ($topUp->status === 'pending')

                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                                    Pending

                                                </span>


                                            @elseif ($topUp->status === 'failed')

                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                                    Failed

                                                </span>


                                            @else

                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                    {{ ucfirst($topUp->status) }}
                                                </span>

                                            @endif

                                        </div>


                                        {{-- Date --}}
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $topUp->created_at?->format('M d, Y • h:i A') }}
                                        </p>


                                        {{-- Reference --}}
                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500 truncate">
                                            {{ $topUp->reference }}
                                        </p>

                                    </div>


                                    {{-- Amount --}}
                                    <div class="text-right flex-shrink-0">


                                        <p class="text-lg sm:text-xl font-bold text-green-600 dark:text-green-400">
                                            +₱{{ number_format((float) $topUp->amount, 2) }}
                                        </p>


                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            {{ $topUp->provider ? ucfirst($topUp->provider) : 'Wallet' }}
                                        </p>


                                        <span class="hidden sm:inline-block mt-1 text-xs text-gray-400 dark:text-gray-500 group-hover:text-blue-500 transition">
                                            View details →
                                        </span>

                                    </div>


                                </div>

                            </a>


                        @endforeach


                    </div>


                    {{-- Pagination --}}
                    @if ($topUps->hasPages())

                        <div class="px-5 sm:px-7 py-5 border-t border-gray-100 dark:border-gray-700">

                            {{ $topUps->links() }}

                        </div>

                    @endif


                @else


                    {{-- Empty State --}}
                    <div class="px-6 py-16 text-center">


                        <div class="mx-auto w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center">

                            <span class="text-2xl">
                                💰
                            </span>

                        </div>


                        <h3 class="mt-5 text-xl font-bold text-gray-900 dark:text-gray-100">
                            No top-ups yet
                        </h3>


                        <p class="mt-2 max-w-sm mx-auto text-sm leading-6 text-gray-500 dark:text-gray-400">
                            You haven't added money to your AMEPSO wallet yet.
                            Your completed top-ups will appear here.
                        </p>


                        <a
                            href="{{ route('topup.index') }}"
                            class="inline-flex items-center gap-2 mt-7 px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition"
                        >
                            <span>＋</span>
                            Make Your First Top Up
                        </a>

                    </div>


                @endif


            </div>


            {{-- Back --}}
            <div class="mt-6">

                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition"
                >
                    ← Back to Dashboard
                </a>

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