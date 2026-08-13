<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                ORMECO Management
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Monitor electricity bills and payment activity.
            </p>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>

                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">
                        Administration
                    </p>

                    <h1 class="mt-1 text-3xl font-bold text-gray-900 dark:text-gray-100">
                        ORMECO Bills
                    </h1>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Monitor electricity accounts and bill payments.
                    </p>

                </div>


                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                >
                    ← Admin Dashboard
                </a>

            </div>


            {{-- Status Filters --}}
            <div class="mb-6 flex flex-wrap gap-2">

                {{-- All --}}
                <a
                    href="{{ route('admin.ormeco.index') }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ !$status
                        ? 'bg-blue-600 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    All
                </a>


                {{-- Paid --}}
                <a
                    href="{{ route('admin.ormeco.index', ['status' => 'paid']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ $status === 'paid'
                        ? 'bg-green-600 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    Paid
                </a>


                {{-- Unpaid --}}
                <a
                    href="{{ route('admin.ormeco.index', ['status' => 'unpaid']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold transition
                    {{ $status === 'unpaid'
                        ? 'bg-yellow-500 text-white'
                        : 'bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                >
                    Unpaid
                </a>

            </div>


            {{-- Bills Table --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">

                @if ($bills->count())

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50 dark:bg-gray-700/50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Account
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Bill Number
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Amount
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Billing Date
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Due Date
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Paid Date
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                                @foreach ($bills as $bill)

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">

                                        {{-- Account --}}
                                        <td class="px-6 py-5">

                                            <p class="font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $bill->ormecoAccount?->account_name ?? 'Unknown Account' }}
                                            </p>

                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Account #{{ $bill->ormecoAccount?->account_number ?? 'N/A' }}
                                            </p>

                                            @if ($bill->ormecoAccount?->user)

                                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                    User:
                                                    {{ $bill->ormecoAccount->user->name }}
                                                </p>

                                            @endif

                                        </td>


                                        {{-- Bill Number --}}
                                        <td class="px-6 py-5">

                                            <span class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ $bill->bill_number }}
                                            </span>

                                        </td>


                                        {{-- Amount --}}
                                        <td class="px-6 py-5">

                                            <span class="font-bold text-gray-900 dark:text-gray-100">
                                                ₱{{ number_format((float) $bill->amount, 2) }}
                                            </span>

                                        </td>


                                        {{-- Billing Date --}}
                                        <td class="px-6 py-5">

                                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                                {{ $bill->billing_date?->format('M d, Y') ?? 'N/A' }}
                                            </span>

                                        </td>


                                        {{-- Due Date --}}
                                        <td class="px-6 py-5">

                                            <span class="text-sm text-gray-700 dark:text-gray-300">
                                                {{ $bill->due_date?->format('M d, Y') ?? 'N/A' }}
                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td class="px-6 py-5">

                                            @if ($bill->status === 'paid')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">
                                                    Paid
                                                </span>

                                            @elseif ($bill->status === 'unpaid')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300">
                                                    Unpaid
                                                </span>

                                            @else

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                    {{ ucfirst($bill->status) }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Paid Date --}}
                                        <td class="px-6 py-5">

                                            @if ($bill->paid_at)

                                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                                    {{ $bill->paid_at->format('M d, Y') }}
                                                </p>

                                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                    {{ $bill->paid_at->format('h:i A') }}
                                                </p>

                                            @else

                                                <span class="text-sm text-gray-400 dark:text-gray-500">
                                                    —
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    @if ($bills->hasPages())

                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">

                            {{ $bills->links() }}

                        </div>

                    @endif

                @else

                    <div class="p-12 text-center">

                        <div class="text-4xl">
                            ⚡
                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            No ORMECO bills found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            There are no electricity bills matching this filter.
                        </p>

                    </div>

                @endif

            </div>


            {{-- Back --}}
            <div class="mt-6">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                >
                    ← Back to Admin Dashboard
                </a>

            </div>

        </div>

    </div>

</x-app-layout>