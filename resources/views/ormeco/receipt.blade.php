<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                Payment Receipt
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Your ORMECO payment has been successfully recorded.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Success Message --}}
            @if (session('success'))

                <div class="mb-6 rounded-2xl border border-green-200 dark:border-green-900 bg-green-50 dark:bg-green-900/20 p-5">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center flex-shrink-0">
                            ✓
                        </div>

                        <div>

                            <p class="text-sm font-semibold text-green-800 dark:text-green-300">
                                Payment completed successfully
                            </p>

                            <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Receipt --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">


                {{-- Receipt Header --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-indigo-700 text-white">

                    <div class="absolute -right-16 -top-16 w-48 h-48 rounded-full bg-white/10"></div>

                    <div class="absolute -left-20 -bottom-24 w-56 h-56 rounded-full bg-white/5"></div>


                    <div class="relative px-6 sm:px-8 py-9 text-center">

                        <div class="mx-auto w-16 h-16 rounded-2xl bg-white/15 flex items-center justify-center">

                            <span class="text-2xl">
                                ⚡
                            </span>

                        </div>


                        <h1 class="mt-5 text-2xl font-bold">
                            AMEPSO
                        </h1>


                        <p class="mt-1 text-sm text-blue-100">
                            ORMECO Payment Receipt
                        </p>

                    </div>

                </div>


                {{-- Success Section --}}
                <div class="px-6 sm:px-8 pt-8 pb-7 text-center">


                    <div class="mx-auto w-20 h-20 rounded-full bg-green-100 dark:bg-green-900/40 flex items-center justify-center">

                        <span class="text-4xl text-green-600 dark:text-green-400">
                            ✓
                        </span>

                    </div>


                    <h1 class="mt-5 text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">
                        Payment Successful
                    </h1>


                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Your ORMECO electricity bill has been successfully paid.
                    </p>


                    {{-- Amount --}}
                    <p class="mt-6 text-4xl sm:text-5xl font-bold text-green-600 dark:text-green-400">
                        ₱{{ number_format((float) $bill->amount, 2) }}
                    </p>


                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Amount Paid
                    </p>


                    {{-- Status --}}
                    <div class="mt-5">

                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300 text-xs font-bold">

                            <span class="w-2 h-2 rounded-full bg-green-500"></span>

                            PAID

                        </span>

                    </div>

                </div>


                {{-- Divider --}}
                <div class="px-6 sm:px-8">

                    <div class="border-t border-dashed border-gray-300 dark:border-gray-600"></div>

                </div>


                {{-- Account Information --}}
                <div class="px-6 sm:px-8 py-6">


                    <div class="mb-5">

                        <h3 class="font-bold text-gray-900 dark:text-gray-100">
                            Account Information
                        </h3>

                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Electricity account associated with this payment.
                        </p>

                    </div>


                    <div class="rounded-2xl bg-gray-50 dark:bg-gray-700/40 border border-gray-100 dark:border-gray-700 overflow-hidden">


                        {{-- Account Name --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Account Name
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right">
                                {{ $bill->ormecoAccount->account_name }}
                            </span>

                        </div>


                        {{-- Account Number --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Account Number
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right">
                                {{ $bill->ormecoAccount->account_number }}
                            </span>

                        </div>


                        {{-- Meter Number --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Meter Number
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right">
                                {{ $bill->ormecoAccount->meter_number ?? 'N/A' }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Payment Information --}}
                <div class="px-6 sm:px-8 pb-6">


                    <div class="mb-5">

                        <h3 class="font-bold text-gray-900 dark:text-gray-100">
                            Payment Information
                        </h3>

                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Details of your completed electricity payment.
                        </p>

                    </div>


                    <div class="rounded-2xl bg-gray-50 dark:bg-gray-700/40 border border-gray-100 dark:border-gray-700 overflow-hidden">


                        {{-- Bill Number --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Bill Number
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right">
                                {{ $bill->bill_number }}
                            </span>

                        </div>


                        {{-- Payment Date --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Payment Date
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 text-right">
                                {{ $bill->paid_at?->format('F d, Y • h:i A') ?? 'N/A' }}
                            </span>

                        </div>


                        {{-- Payment Method --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-4 border-b border-gray-200 dark:border-gray-600">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Payment Method
                            </span>

                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                AMEPSO Wallet
                            </span>

                        </div>


                        {{-- Amount --}}
                        <div class="flex items-center justify-between gap-5 px-5 py-5">

                            <span class="font-semibold text-gray-700 dark:text-gray-300">
                                Amount Paid
                            </span>

                            <span class="text-xl font-bold text-green-600 dark:text-green-400">
                                ₱{{ number_format((float) $bill->amount, 2) }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Confirmation --}}
                <div class="px-6 sm:px-8 pb-6">

                    <div class="p-5 rounded-2xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900">

                        <div class="flex gap-4">

                            <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/50 flex items-center justify-center text-green-600 dark:text-green-400 flex-shrink-0">
                                ✓
                            </div>

                            <div>

                                <p class="text-sm font-bold text-green-800 dark:text-green-300">
                                    Payment successfully recorded
                                </p>

                                <p class="mt-1 text-sm text-green-700 dark:text-green-400">
                                    Your ORMECO bill has been marked as paid and the amount was deducted from your AMEPSO wallet.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Receipt Footer --}}
                <div class="px-6 sm:px-8">

                    <div class="pt-6 border-t border-dashed border-gray-300 dark:border-gray-600 text-center">

                        <p class="text-xs text-gray-400 dark:text-gray-500">
                            This receipt was generated by AMEPSO.
                        </p>

                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                            Keep this receipt for your records.
                        </p>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="px-6 sm:px-8 pt-6 pb-8 flex flex-col sm:flex-row gap-3">


                    <a
                        href="{{ route('dashboard') }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition"
                    >
                        ← Dashboard
                    </a>


                    <a
                        href="{{ route('transactions.index') }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 py-3.5 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                    >
                        View Transactions →
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