<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Create ORMECO Bill
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Create a new electricity bill for an ORMECO account.
            </p>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-6">

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
                        <ul class="text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.ormeco-bills.store') }}">
                    @csrf

                    {{-- ORMECO Account --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            ORMECO Account
                        </label>

                        <select
                            name="ormeco_account_id"
                            class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white"
                            required
                        >
                            <option value="">Select an account</option>

                            @foreach ($accounts as $account)
                                <option
                                    value="{{ $account->id }}"
                                    {{ old('ormeco_account_id') == $account->id ? 'selected' : '' }}
                                >
                                    {{ $account->account_number }}
                                    —
                                    {{ $account->account_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Amount --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Bill Amount
                        </label>

                        <input
                            type="number"
                            name="amount"
                            value="{{ old('amount') }}"
                            step="0.01"
                            min="0.01"
                            placeholder="0.00"
                            class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white"
                            required
                        >
                    </div>

                    {{-- Billing Date --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Billing Date
                        </label>

                        <input
                            type="date"
                            name="billing_date"
                            value="{{ old('billing_date', now()->format('Y-m-d')) }}"
                            class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white"
                            required
                        >
                    </div>

                    {{-- Due Date --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            value="{{ old('due_date') }}"
                            class="w-full rounded-xl border-gray-300 dark:bg-gray-700 dark:text-white"
                            required
                        >
                    </div>

                    <div class="flex gap-3">

                        <a
                            href="{{ route('admin.ormeco-bills.index') }}"
                            class="px-5 py-3 rounded-xl border border-gray-300 text-gray-700"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold"
                        >
                            Create Bill
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>