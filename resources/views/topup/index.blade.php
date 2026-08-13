<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                Top Up Wallet
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Add money securely to your AMEPSO wallet.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Heading --}}
            <div class="mb-8">

                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                    Wallet
                </p>

                <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Add money
                </h1>

                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Choose an amount and continue to secure payment.
                </p>

            </div>


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-900/20 p-5">

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center flex-shrink-0">
                            ⚠️
                        </div>

                        <div>

                            <p class="font-semibold text-red-800 dark:text-red-300">
                                Please check your amount
                            </p>

                            <ul class="mt-2 text-sm text-red-700 dark:text-red-400 space-y-1">

                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Payment Error --}}
            @if (session('error'))

                <div class="mb-6 rounded-2xl border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-900/20 p-5">

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center flex-shrink-0">
                            ⚠️
                        </div>

                        <div>

                            <p class="font-semibold text-red-800 dark:text-red-300">
                                Payment error
                            </p>

                            <p class="mt-1 text-sm text-red-700 dark:text-red-400">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Main Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">


                {{-- Amount Card --}}
                <div class="lg:col-span-3 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">

                    <div class="p-6 sm:p-8">


                        {{-- Icon + Heading --}}
                        <div class="flex items-start gap-4 mb-8">

                            <div class="w-14 h-14 rounded-2xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center flex-shrink-0">

                                <span class="text-2xl">
                                    💰
                                </span>

                            </div>

                            <div>

                                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                    Choose amount
                                </h2>

                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Enter how much you want to add.
                                </p>

                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('topup.store') }}"
                        >

                            @csrf


                            {{-- Amount --}}
                            <div>

                                <label
                                    for="amount"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300"
                                >
                                    Top up amount
                                </label>


                                <div class="relative mt-2">

                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-xl font-bold text-green-600 dark:text-green-400">
                                        ₱
                                    </span>

                                    <input
                                        id="amount"
                                        name="amount"
                                        type="number"
                                        min="50"
                                        max="50000"
                                        step="0.01"
                                        value="{{ old('amount') }}"
                                        placeholder="0.00"
                                        required
                                        autofocus
                                        class="block w-full pl-11 pr-5 py-4 text-2xl font-bold rounded-2xl border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-blue-500"
                                    >

                                </div>


                                <div class="flex items-center justify-between mt-3">

                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Minimum ₱50.00
                                    </p>

                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Maximum ₱50,000.00
                                    </p>

                                </div>

                            </div>


                            {{-- Quick Amounts --}}
                            <div class="mt-8">

                                <div class="flex items-center justify-between mb-3">

                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Quick amount
                                    </p>

                                    <p class="text-xs text-gray-400 dark:text-gray-500">
                                        Tap to select
                                    </p>

                                </div>


                                <div class="grid grid-cols-3 gap-3">

                                    <button
                                        type="button"
                                        onclick="document.getElementById('amount').value = '100'"
                                        class="py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-semibold hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-700 dark:hover:text-green-300 transition"
                                    >
                                        ₱100
                                    </button>


                                    <button
                                        type="button"
                                        onclick="document.getElementById('amount').value = '500'"
                                        class="py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-semibold hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-700 dark:hover:text-green-300 transition"
                                    >
                                        ₱500
                                    </button>


                                    <button
                                        type="button"
                                        onclick="document.getElementById('amount').value = '1000'"
                                        class="py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-semibold hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 hover:text-green-700 dark:hover:text-green-300 transition"
                                    >
                                        ₱1,000
                                    </button>

                                </div>

                            </div>


                            {{-- Actions --}}
                            <div class="mt-8 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-4">

                                <a
                                    href="{{ route('dashboard') }}"
                                    class="text-center sm:text-left text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition"
                                >
                                    ← Back to Dashboard
                                </a>


                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-sm hover:shadow transition"
                                >
                                    Continue to Payment
                                    <span>→</span>
                                </button>

                            </div>

                        </form>

                    </div>

                </div>


                {{-- Information Card --}}
                <div class="lg:col-span-2 space-y-6">


                    {{-- Payment Info --}}
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-lg">

                        <div class="absolute -right-12 -top-12 w-36 h-36 rounded-full bg-white/10"></div>

                        <div class="relative p-7">

                            <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center">

                                <span class="text-xl">
                                    🔐
                                </span>

                            </div>


                            <h3 class="mt-5 text-xl font-bold">
                                Secure payment
                            </h3>


                            <p class="mt-2 text-sm leading-6 text-blue-100">
                                Your payment will be processed securely through PayMongo.
                            </p>


                            <div class="mt-6 space-y-3">

                                <div class="flex items-center gap-3">

                                    <div class="w-7 h-7 rounded-full bg-white/15 flex items-center justify-center text-xs">
                                        ✓
                                    </div>

                                    <span class="text-sm text-blue-50">
                                        Secure checkout
                                    </span>

                                </div>


                                <div class="flex items-center gap-3">

                                    <div class="w-7 h-7 rounded-full bg-white/15 flex items-center justify-center text-xs">
                                        ✓
                                    </div>

                                    <span class="text-sm text-blue-50">
                                        GCash supported
                                    </span>

                                </div>


                                <div class="flex items-center gap-3">

                                    <div class="w-7 h-7 rounded-full bg-white/15 flex items-center justify-center text-xs">
                                        ✓
                                    </div>

                                    <span class="text-sm text-blue-50">
                                        Wallet credited after confirmation
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- How It Works --}}
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm p-7">

                        <h3 class="font-bold text-gray-900 dark:text-gray-100">
                            How it works
                        </h3>


                        <div class="mt-5 space-y-5">


                            <div class="flex gap-4">

                                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 flex items-center justify-center text-sm font-bold flex-shrink-0">
                                    1
                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                        Choose an amount
                                    </p>

                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Select a quick amount or enter your own.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-4">

                                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 flex items-center justify-center text-sm font-bold flex-shrink-0">
                                    2
                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                        Complete payment
                                    </p>

                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Continue to PayMongo checkout.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-4">

                                <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 flex items-center justify-center text-sm font-bold flex-shrink-0">
                                    3
                                </div>

                                <div>

                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                        Wallet credited
                                    </p>

                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Your wallet is updated after payment confirmation.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

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