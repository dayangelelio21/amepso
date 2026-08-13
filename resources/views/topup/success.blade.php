<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Top Up Payment
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Payment confirmation
            </p>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-2xl overflow-hidden">

                <div class="p-8 text-center">

                    {{-- Icon --}}
                    <div class="mx-auto w-20 h-20 rounded-full bg-green-100 dark:bg-green-900/40 flex items-center justify-center">

                        <span class="text-4xl text-green-600 dark:text-green-400">
                            ✓
                        </span>

                    </div>

                    <h3 class="mt-6 text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Payment Submitted
                    </h3>

                    <p class="mt-3 text-gray-500 dark:text-gray-400">
                        You have returned to AMEPSO after completing your PayMongo payment.
                    </p>

                    {{-- Important Notice --}}
                    <div class="mt-6 p-5 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-900 text-left">

                        <p class="text-sm font-semibold text-blue-800 dark:text-blue-300">
                            Payment confirmation
                        </p>

                        <p class="mt-2 text-sm text-blue-700 dark:text-blue-400">
                            AMEPSO is waiting for PayMongo to confirm the payment.
                            Your wallet is credited only after the payment is verified.
                        </p>

                    </div>

                    {{-- Status --}}
                    <div class="mt-6 flex items-center justify-center gap-2">

                        <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span>

                        <span class="text-sm font-medium text-gray-600 dark:text-gray-300">
                            Waiting for payment confirmation
                        </span>

                    </div>

                    {{-- Actions --}}
                    <div class="mt-8 flex flex-col sm:flex-row gap-3">

                        <a
                            href="{{ route('dashboard') }}"
                            class="flex-1 px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition"
                        >
                            Go to Dashboard
                        </a>

                        <a
                            href="{{ route('topup.index') }}"
                            class="flex-1 px-5 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                        >
                            Top Up Again
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>