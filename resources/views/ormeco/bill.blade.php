<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                ORMECO Bill
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Review your electricity bill before making a payment.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Page Header --}}
            <div class="mb-8">

                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                    Electricity
                </p>

                <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Review your bill
                </h1>

                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Confirm the bill details and payment amount before continuing.
                </p>

            </div>


            {{-- Error --}}
            @if (session('error'))

                <div class="mb-6 rounded-2xl border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-900/20 p-5">

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center flex-shrink-0">
                            ⚠️
                        </div>

                        <div>

                            <p class="font-semibold text-red-800 dark:text-red-300">
                                Payment could not be completed
                            </p>

                            <p class="mt-1 text-sm text-red-700 dark:text-red-400">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Main Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">


                {{-- Bill Card --}}
                <div class="lg:col-span-3 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">


                    {{-- Account Header --}}
                    <div class="p-6 sm:p-8 border-b border-gray-100 dark:border-gray-700">

                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center flex-shrink-0">

                                <span class="text-2xl">
                                    ⚡
                                </span>

                            </div>


                            <div class="min-w-0">

                                <p class="text-xs font-semibold uppercase tracking-wide text-blue-600 dark:text-blue-400">
                                    ORMECO Account
                                </p>

                                <h2 class="mt-1 text-xl font-bold text-gray-900 dark:text-gray-100 truncate">
                                    {{ $account->account_name }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Account #{{ $account->account_number }}
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Bill Information --}}
                    <div class="p-6 sm:p-8">


                        <div class="flex items-center justify-between mb-5">

                            <div>

                                <h3 class="font-bold text-gray-900 dark:text-gray-100">
                                    Bill Information
                                </h3>

                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Current unpaid electricity bill
                                </p>

                            </div>


                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300">

                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                Unpaid

                            </span>

                        </div>


                        <div class="rounded-2xl bg-gray-50 dark:bg-gray-700/40 border border-gray-100 dark:border-gray-700 overflow-hidden">


                            {{-- Bill Number --}}
                            <div class="flex items-center justify-between gap-4 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Bill Number
                                </span>

                                <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right">
                                    {{ $bill->bill_number }}
                                </span>

                            </div>


                            {{-- Billing Date --}}
                            <div class="flex items-center justify-between gap-4 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Billing Date
                                </span>

                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $bill->billing_date?->format('F d, Y') ?? 'N/A' }}
                                </span>

                            </div>


                            {{-- Due Date --}}
                            <div class="flex items-center justify-between gap-4 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    Due Date
                                </span>

                                <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $bill->due_date?->format('F d, Y') ?? 'N/A' }}
                                </span>

                            </div>


                            {{-- Amount --}}
                            <div class="px-5 py-6">

                                <div class="flex items-end justify-between gap-4">

                                    <div>

                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Amount Due
                                        </p>

                                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                            Total amount to be paid
                                        </p>

                                    </div>


                                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                        ₱{{ number_format((float) $bill->amount, 2) }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Account Details --}}
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">


                            <div class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-900">

                                <p class="text-xs font-medium text-blue-600 dark:text-blue-400">
                                    Meter Number
                                </p>

                                <p class="mt-1 font-semibold text-blue-900 dark:text-blue-200">
                                    {{ $account->meter_number ?? 'N/A' }}
                                </p>

                            </div>


                            <div class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-900">

                                <p class="text-xs font-medium text-blue-600 dark:text-blue-400">
                                    Service Address
                                </p>

                                <p class="mt-1 font-semibold text-blue-900 dark:text-blue-200">
                                    {{ $account->service_address ?? 'N/A' }}
                                </p>

                            </div>


                        </div>


                    </div>

                </div>


                {{-- Payment Panel --}}
                <div class="lg:col-span-2">


                    <div class="sticky top-6 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">


                        {{-- Payment Header --}}
                        <div class="p-6 bg-gradient-to-br from-blue-600 to-indigo-700 text-white relative overflow-hidden">

                            <div class="absolute -right-14 -top-14 w-40 h-40 rounded-full bg-white/10"></div>


                            <div class="relative">

                                <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center">

                                    <span class="text-xl">
                                        💳
                                    </span>

                                </div>


                                <h3 class="mt-5 text-xl font-bold">
                                    Pay with AMEPSO
                                </h3>


                                <p class="mt-1 text-sm text-blue-100">
                                    Payment will be deducted directly from your wallet.
                                </p>

                            </div>

                        </div>


                        <div class="p-6">


                            {{-- Wallet Balance --}}
                            <div class="p-5 rounded-2xl bg-gray-50 dark:bg-gray-700/40 border border-gray-100 dark:border-gray-700">

                                <div class="flex items-center justify-between">

                                    <div>

                                        <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                            Current Wallet Balance
                                        </p>

                                        <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            ₱{{ number_format((float) Auth::user()->wallet->balance, 2) }}
                                        </p>

                                    </div>


                                    <div class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center">
                                        💰
                                    </div>

                                </div>

                            </div>


                            {{-- Payment Summary --}}
                            <div class="mt-5 space-y-3">


                                <div class="flex justify-between text-sm">

                                    <span class="text-gray-500 dark:text-gray-400">
                                        Bill Amount
                                    </span>

                                    <span class="font-semibold text-gray-900 dark:text-gray-100">
                                        ₱{{ number_format((float) $bill->amount, 2) }}
                                    </span>

                                </div>


                                <div class="flex justify-between text-sm">

                                    <span class="text-gray-500 dark:text-gray-400">
                                        Payment Method
                                    </span>

                                    <span class="font-semibold text-gray-900 dark:text-gray-100">
                                        AMEPSO Wallet
                                    </span>

                                </div>


                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 flex justify-between">

                                    <span class="font-semibold text-gray-700 dark:text-gray-300">
                                        Total Payment
                                    </span>

                                    <span class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                        ₱{{ number_format((float) $bill->amount, 2) }}
                                    </span>

                                </div>

                            </div>


                            {{-- Balance Check --}}
                            @if ((float) Auth::user()->wallet->balance >= (float) $bill->amount)

                                <div class="mt-5 p-4 rounded-2xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900">

                                    <div class="flex items-start gap-3">

                                        <span class="text-green-600 dark:text-green-400">
                                            ✓
                                        </span>

                                        <div>

                                            <p class="text-sm font-semibold text-green-800 dark:text-green-300">
                                                Sufficient wallet balance
                                            </p>

                                            <p class="mt-1 text-xs text-green-700 dark:text-green-400">
                                                You have enough funds to complete this payment.
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                <form
                                    method="POST"
                                    action="{{ route('ormeco.pay', $bill) }}"
                                    class="mt-5"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="w-full inline-flex items-center justify-center gap-2 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-sm hover:shadow transition"
                                    >
                                        Pay ₱{{ number_format((float) $bill->amount, 2) }}
                                        <span>→</span>
                                    </button>

                                </form>


                            @else

                                <div class="mt-5 p-4 rounded-2xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-900">

                                    <div class="flex items-start gap-3">

                                        <span class="text-red-600 dark:text-red-400">
                                            ⚠️
                                        </span>

                                        <div>

                                            <p class="text-sm font-semibold text-red-800 dark:text-red-300">
                                                Insufficient wallet balance
                                            </p>

                                            <p class="mt-1 text-xs text-red-700 dark:text-red-400">
                                                Please top up your wallet before paying this bill.
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                <a
                                    href="{{ route('topup.index') }}"
                                    class="mt-5 w-full inline-flex items-center justify-center gap-2 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition"
                                >
                                    Top Up Wallet
                                    <span>→</span>
                                </a>

                            @endif


                            {{-- Search Another Account --}}
                            <a
                                href="{{ route('ormeco.index') }}"
                                class="mt-4 block text-center text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition"
                            >
                                ← Search another account
                            </a>


                        </div>

                    </div>

                </div>


            </div>


            {{-- Security Notice --}}
            <div class="mt-6 rounded-2xl bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-900 p-5">

                <div class="flex gap-3">

                    <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center flex-shrink-0">
                        🔐
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-green-800 dark:text-green-300">
                            Secure wallet payment
                        </p>

                        <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                            Your wallet balance will only be deducted after the payment is successfully processed.
                        </p>

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