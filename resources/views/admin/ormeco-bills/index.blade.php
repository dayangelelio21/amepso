<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    ORMECO Bills
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage electricity bills.
                </p>
            </div>

            <a
                href="{{ route('admin.ormeco-bills.create') }}"
                class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold"
            >
                + Create Bill
            </a>

        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full text-left">

                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-sm font-semibold">
                                    Bill Number
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold">
                                    Account
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold">
                                    Amount
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold">
                                    Due Date
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold">
                                    Status
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y dark:divide-gray-700">

                            @forelse ($bills as $bill)

                                <tr>

                                    <td class="px-6 py-4 font-medium">
                                        {{ $bill->bill_number }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $bill->ormecoAccount->account_number ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        ₱{{ number_format($bill->amount, 2) }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($bill->due_date)->format('M d, Y') }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if ($bill->status === 'paid')

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                Paid
                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                Unpaid
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        No ORMECO bills found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="p-6">
                    {{ $bills->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>