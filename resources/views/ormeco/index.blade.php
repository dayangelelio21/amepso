<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                Pay ORMECO Bill
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Pay your electricity bill securely using your AMEPSO wallet.
            </p>
        </div>
    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Page Heading --}}
            <div class="mb-8">

                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                    Electricity
                </p>

                <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Pay your ORMECO bill
                </h1>

                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Find your account and pay your current electricity bill from your AMEPSO wallet.
                </p>

            </div>


            {{-- Error Message --}}
            @if (session('error'))

                <div class="mb-6 rounded-2xl border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-900/20 p-5">

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center flex-shrink-0">
                            ⚠️
                        </div>

                        <div>

                            <p class="font-semibold text-red-800 dark:text-red-300">
                                Unable to find your bill
                            </p>

                            <p class="mt-1 text-sm text-red-700 dark:text-red-400">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Validation Error --}}
            @if ($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 dark:border-red-900 bg-red-50 dark:bg-red-900/20 p-5">

                    <div class="flex gap-3">

                        <div class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center flex-shrink-0">
                            ⚠️
                        </div>

                        <div>

                            <p class="font-semibold text-red-800 dark:text-red-300">
                                Please check your account number
                            </p>

                            <ul class="mt-1 text-sm text-red-700 dark:text-red-400 space-y-1">

                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- Main Layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">


                {{-- Account Lookup --}}
                <div class="lg:col-span-3 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm overflow-hidden">

                    <div class="p-6 sm:p-8">


                        {{-- Icon + Heading --}}
                        <div class="flex items-start gap-4 mb-8">

                            <div class="w-14 h-14 rounded-2xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center flex-shrink-0">

                                <span class="text-2xl">
                                    ⚡
                                </span>

                            </div>

                            <div>

                                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                    Find your bill
                                </h2>

                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Enter your ORMECO account number to continue.
                                </p>

                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('ormeco.lookup') }}"
                        >

                            @csrf


                            {{-- Account Number --}}
                            <div>

                                <label
                                    for="account_number"
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300"
                                >
                                    ORMECO Account Number
                                </label>


                                <div class="relative mt-2">

                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                                        <span class="text-gray-400 dark:text-gray-500">
                                            ⚡
                                        </span>

                                    </div>


                                    <input
                                        id="account_number"
                                        name="account_number"
                                        type="text"
                                        value="{{ old('account_number') }}"
                                        placeholder="Enter your account number"
                                        required
                                        autofocus
                                        class="block w-full pl-11 pr-4 py-4 rounded-2xl border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-blue-500 focus:ring-blue-500"
                                    >

                                </div>


                                @error('account_number')

                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </p>

                                @enderror


                                <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                                    Enter the account number associated with your ORMECO account.
                                </p>

                            </div>


                            {{-- Action --}}
                            <div class="mt-8 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-between gap-4">


                                <a
                                    href="{{ route('dashboard') }}"
                                    class="text-center sm:text-left text-sm font-semibold text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 transition"
                                >
                                    ← Back to Dashboard
                                </a>


                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-sm hover:shadow transition"
                                >
                                    Find Bill
                                    <span>→</span>
                                </button>


                            </div>


                        </form>

                    </div>

                </div>


                {{-- Information Side --}}
                <div class="lg:col-span-2 space-y-6">


                    {{-- Electricity Card --}}
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 text-white shadow-lg">

                        <div class="absolute -right-14 -top-14 w-40 h-40 rounded-full bg-white/10"></div>

                        <div class="absolute -left-16 -bottom-20 w-48 h-48 rounded-full bg-white/5"></div>


                        <div class="relative p-7">

                            <div class="w-12 h-12 rounded-2xl bg-white/15 flex items-center justify-center">

                                <span class="text-xl">
                                    ⚡
                                </span>

                            </div>


                            <h3 class="mt-5 text-xl font-bold">
                                Electricity payments
                            </h3>


                            <p class="mt-2 text-sm leading-6 text-blue-100">
                                Pay your ORMECO electricity bill directly from your AMEPSO wallet.
                            </p>


                            <div class="mt-6 space-y-3">


                                <div class="flex items-center gap-3">

                                    <div class="w-7 h-7 rounded-full bg-white/15 flex items-center justify-center text-xs">
                                        1
                                    </div>

                                    <span class="text-sm text-blue-50">
                                        Enter your account number
                                    </span>

                                </div>


                                <div class="flex items-center gap-3">

                                    <div class="w-7 h-7 rounded-full bg-white/15 flex items-center justify-center text-xs">
                                        2
                                    </div>

                                    <span class="text-sm text-blue-50">
                                        Review your electricity bill
                                    </span>

                                </div>


                                <div class="flex items-center gap-3">

                                    <div class="w-7 h-7 rounded-full bg-white/15 flex items-center justify-center text-xs">
                                        3
                                    </div>

                                    <span class="text-sm text-blue-50">
                                        Pay using your wallet
                                    </span>

                                </div>


                            </div>

                        </div>

                    </div>


                    {{-- Security Info --}}
                    <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-sm p-7">

                        <div class="flex items-center gap-3">

                            <div class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center">
                                🔐
                            </div>

                            <div>

                                <h3 class="font-bold text-gray-900 dark:text-gray-100">
                                    Secure payment
                                </h3>

                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Powered by your AMEPSO wallet
                                </p>

                            </div>

                        </div>


                        <div class="mt-5 space-y-3">


                            <div class="flex items-start gap-3">

                                <span class="text-green-600 dark:text-green-400 mt-0.5">
                                    ✓
                                </span>

                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    Your bill details are checked before payment.
                                </p>

                            </div>


                            <div class="flex items-start gap-3">

                                <span class="text-green-600 dark:text-green-400 mt-0.5">
                                    ✓
                                </span>

                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    Your wallet balance is verified before deduction.
                                </p>

                            </div>


                            <div class="flex items-start gap-3">

                                <span class="text-green-600 dark:text-green-400 mt-0.5">
                                    ✓
                                </span>

                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    A payment receipt is available after completion.
                                </p>

                            </div>


                        </div>

                    </div>

                </div>

            </div>


            {{-- Development Test Account --}}
            <div class="mt-6 rounded-2xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-900 p-5">

                <div class="flex gap-3">

                    <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center flex-shrink-0">
                        🧪
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">
                            Development Test Account
                        </p>

                        <p class="mt-1 text-sm text-amber-700 dark:text-amber-400">
                            Account Number:
                            <strong>123456789</strong>
                        </p>

                        <p class="mt-1 text-xs text-amber-600 dark:text-amber-500">
                            This information is for local development testing only.
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