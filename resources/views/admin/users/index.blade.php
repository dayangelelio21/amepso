<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                User Management
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                View and manage AMEPSO user accounts and administrator access.
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
                        Users
                    </h1>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Manage registered AMEPSO users and administrator access.
                    </p>

                </div>


                <a
                    href="{{ route('admin.dashboard') }}"
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200"
                >
                    ← Admin Dashboard
                </a>

            </div>


            {{-- Success Message --}}
            @if (session('success'))

                <div
                    class="mb-6 rounded-xl
                           border border-green-200
                           dark:border-green-800
                           bg-green-50
                           dark:bg-green-900/20
                           px-5 py-4"
                >

                    <p class="text-sm font-medium text-green-700 dark:text-green-300">
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- Error Message --}}
            @if (session('error'))

                <div
                    class="mb-6 rounded-xl
                           border border-red-200
                           dark:border-red-800
                           bg-red-50
                           dark:bg-red-900/20
                           px-5 py-4"
                >

                    <p class="text-sm font-medium text-red-700 dark:text-red-300">
                        {{ session('error') }}
                    </p>

                </div>

            @endif


            {{-- Validation Errors --}}
            @if ($errors->any())

                <div
                    class="mb-6 rounded-xl
                           border border-red-200
                           dark:border-red-800
                           bg-red-50
                           dark:bg-red-900/20
                           px-5 py-4"
                >

                    @foreach ($errors->all() as $error)

                        <p class="text-sm text-red-700 dark:text-red-300">
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            @endif


            {{-- Search --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl p-5 mb-6">

                <form
                    method="GET"
                    action="{{ route('admin.users.index') }}"
                    class="flex flex-col sm:flex-row gap-3"
                >

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search by name or email..."
                        class="flex-1 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-blue-500 focus:ring-blue-500"
                    >

                    <button
                        type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition"
                    >
                        Search
                    </button>

                    @if ($search)

                        <a
                            href="{{ route('admin.users.index') }}"
                            class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl text-center hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                        >
                            Clear
                        </a>

                    @endif

                </form>

            </div>


            {{-- Users --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl overflow-hidden">

                @if ($users->count())

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50 dark:bg-gray-700/50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        User
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Role
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Wallet Balance
                                    </th>

                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Registered
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                                @foreach ($users as $user)

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">

                                        {{-- User --}}
                                        <td class="px-6 py-5">

                                            <div>

                                                <p class="font-semibold text-gray-900 dark:text-gray-100">
                                                    {{ $user->name }}
                                                </p>

                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $user->email }}
                                                </p>

                                            </div>

                                        </td>


                                        {{-- Role --}}
                                        <td class="px-6 py-5">

                                            @if ($user->role === 'admin')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300">
                                                    Admin
                                                </span>

                                            @else

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300">
                                                    User
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Wallet --}}
                                        <td class="px-6 py-5">

                                            <span class="font-semibold text-gray-900 dark:text-gray-100">
                                                ₱{{ number_format((float) ($user->wallet?->balance ?? 0), 2) }}
                                            </span>

                                        </td>


                                        {{-- Registered --}}
                                        <td class="px-6 py-5">

                                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                                {{ $user->created_at?->format('M d, Y') }}
                                            </p>

                                        </td>


                                        {{-- Actions --}}
                                        <td class="px-6 py-5">

                                            <div class="flex flex-col sm:flex-row justify-end gap-2">

                                                {{-- View --}}
                                                <a
                                                    href="{{ route('admin.users.show', $user) }}"
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition"
                                                >
                                                    View
                                                </a>


                                                {{-- Don't allow admin to modify their own role --}}
                                                @if ($user->getKey() !== auth()->user()->getKey())

                                                    @if ($user->role === 'admin')

                                                        {{-- Remove Admin --}}
                                                        <form
                                                            method="POST"
                                                            action="{{ route('admin.users.role', $user) }}"
                                                        >

                                                            @csrf

                                                            @method('PATCH')

                                                            <input
                                                                type="hidden"
                                                                name="role"
                                                                value="user"
                                                            >

                                                            <button
                                                                type="submit"
                                                                onclick="return confirm('Remove administrator access from {{ $user->name }}?')"
                                                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition"
                                                            >
                                                                Remove Admin
                                                            </button>

                                                        </form>

                                                    @else

                                                        {{-- Make Admin --}}
                                                        <form
                                                            method="POST"
                                                            action="{{ route('admin.users.role', $user) }}"
                                                        >

                                                            @csrf

                                                            @method('PATCH')

                                                            <input
                                                                type="hidden"
                                                                name="role"
                                                                value="admin"
                                                            >

                                                            <button
                                                                type="submit"
                                                                onclick="return confirm('Make {{ $user->name }} an administrator?')"
                                                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-lg transition"
                                                            >
                                                                Make Admin
                                                            </button>

                                                        </form>

                                                    @endif

                                                @else

                                                    <span
                                                        class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-sm font-semibold rounded-lg"
                                                    >
                                                        Current Account
                                                    </span>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    @if ($users->hasPages())

                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">

                            {{ $users->links() }}

                        </div>

                    @endif

                @else

                    <div class="p-12 text-center">

                        <div class="text-4xl">
                            👥
                        </div>

                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            No users found
                        </h3>

                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            No AMEPSO users match your search.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>