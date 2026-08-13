<nav
    x-data="{ open: false }"
    class="bg-[#1e293b] border-b border-slate-700/70"
>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- LEFT SIDE --}}
            <div class="flex items-center">

                {{-- Logo --}}
                <div class="shrink-0 flex items-center">

                    <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center gap-3"
                    >

                        <x-application-logo
                            class="block h-9 w-auto fill-current text-white"
                        />

                        <div class="hidden sm:block leading-tight">

                            <p class="font-bold text-white">
                                AMEPSO
                            </p>

                            <p class="text-[11px] text-slate-400">
                                Digital Wallet
                            </p>

                        </div>

                    </a>

                </div>


                {{-- Desktop Navigation --}}
                <div class="hidden sm:flex items-center sm:ms-10 gap-1">

                    {{-- Dashboard --}}
                    <a
                        href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('dashboard')
                            ? 'bg-blue-600 text-white shadow-sm'
                            : 'text-slate-300 hover:text-white hover:bg-slate-700/70' }}"
                    >
                        Dashboard
                    </a>


                    {{-- Top Up --}}
                    <a
                        href="{{ route('topup.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('topup.index')
                            ? 'bg-blue-600 text-white shadow-sm'
                            : 'text-slate-300 hover:text-white hover:bg-slate-700/70' }}"
                    >
                        Top Up
                    </a>


                    {{-- Transactions --}}
                    <a
                        href="{{ route('transactions.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('transactions.*')
                            ? 'bg-blue-600 text-white shadow-sm'
                            : 'text-slate-300 hover:text-white hover:bg-slate-700/70' }}"
                    >
                        Transactions
                    </a>


                    {{-- ORMECO --}}
                    <a
                        href="{{ route('ormeco.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition
                        {{ request()->routeIs('ormeco.*')
                            ? 'bg-blue-600 text-white shadow-sm'
                            : 'text-slate-300 hover:text-white hover:bg-slate-700/70' }}"
                    >
                        <span class="mr-1">⚡</span>
                        ORMECO
                    </a>


                    {{-- ADMIN --}}
                    @if (Auth::check() && Auth::user()->role === 'admin')

                        <div class="flex items-center gap-1 ml-2 pl-2 border-l border-slate-700">

                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="px-4 py-2 rounded-lg text-sm font-medium transition
                                {{ request()->routeIs('admin.*')
                                    ? 'bg-purple-600 text-white shadow-sm'
                                    : 'text-purple-300 hover:text-white hover:bg-purple-700/40' }}"
                            >
                                👑 Admin
                            </a>

                        </div>

                    @endif

                </div>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-slate-300 hover:text-white hover:bg-slate-700/70 focus:outline-none transition"
                        >

                            {{-- Avatar --}}
                            <div
                                class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold"
                            >
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>


                            <div class="text-left">

                                <div class="text-sm font-semibold text-white">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="text-xs text-slate-400">
                                    My Account
                                </div>

                            </div>


                            {{-- Arrow --}}
                            <svg
                                class="fill-current h-4 w-4 text-slate-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >

                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />

                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        {{-- Profile --}}
                        <x-dropdown-link
                            :href="route('profile.edit')"
                        >
                            <span class="mr-2">👤</span>
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        {{-- Admin Dashboard --}}
                        @if (Auth::check() && Auth::user()->role === 'admin')

                            <x-dropdown-link
                                :href="route('admin.dashboard')"
                            >
                                <span class="mr-2">👑</span>
                                {{ __('Admin Dashboard') }}
                            </x-dropdown-link>

                        @endif


                        {{-- Top Up History --}}
                        <x-dropdown-link
                            :href="route('topup.history')"
                        >
                            <span class="mr-2">🧾</span>
                            {{ __('Top Up History') }}
                        </x-dropdown-link>


                        {{-- Logout --}}
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                <span class="mr-2">↪</span>
                                {{ __('Log Out') }}
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            {{-- MOBILE MENU BUTTON --}}
            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-700 focus:outline-none transition"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open}"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open}"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    {{-- MOBILE NAVIGATION --}}
    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden border-t border-slate-700"
    >

        <div class="px-4 pt-3 pb-3 space-y-1">

            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
            >
                <span>🏠</span>
                Dashboard
            </a>


            {{-- Top Up --}}
            <a
                href="{{ route('topup.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('topup.index')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
            >
                <span>💰</span>
                Top Up
            </a>


            {{-- Transactions --}}
            <a
                href="{{ route('transactions.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('transactions.*')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
            >
                <span>🧾</span>
                Transactions
            </a>


            {{-- Top Up History --}}
            <a
                href="{{ route('topup.history') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('topup.history')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
            >
                <span>📋</span>
                Top Up History
            </a>


            {{-- ORMECO --}}
            <a
                href="{{ route('ormeco.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                {{ request()->routeIs('ormeco.*')
                    ? 'bg-blue-600 text-white'
                    : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}"
            >
                <span>⚡</span>
                Pay ORMECO
            </a>


            {{-- ADMIN --}}
            @if (Auth::check() && Auth::user()->role === 'admin')

                <div class="pt-2 mt-2 border-t border-slate-700">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition
                        {{ request()->routeIs('admin.*')
                            ? 'bg-purple-600 text-white'
                            : 'text-purple-300 hover:bg-purple-700/40 hover:text-white' }}"
                    >
                        <span>👑</span>
                        Admin Dashboard
                    </a>

                </div>

            @endif

        </div>


        {{-- MOBILE ACCOUNT --}}
        <div class="border-t border-slate-700 px-4 pt-4 pb-4">

            <div class="flex items-center gap-3 px-2">

                <div
                    class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold"
                >
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>


                <div class="min-w-0">

                    <div class="font-semibold text-white truncate">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-sm text-slate-400 truncate">
                        {{ Auth::user()->email }}
                    </div>

                </div>

            </div>


            <div class="mt-4 space-y-1">

                {{-- Profile --}}
                <a
                    href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-700 hover:text-white transition"
                >
                    <span>👤</span>
                    Profile
                </a>


                {{-- Admin Dashboard --}}
                @if (Auth::check() && Auth::user()->role === 'admin')

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-purple-300 hover:bg-purple-700/40 hover:text-white transition"
                    >
                        <span>👑</span>
                        Admin Dashboard
                    </a>

                @endif


                {{-- Logout --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-700 hover:text-white transition text-left"
                    >
                        <span>↪</span>
                        Log Out
                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>