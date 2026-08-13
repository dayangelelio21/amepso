<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">


            {{-- AMEPSO Branding --}}
            <div class="text-center mb-8">

                <div class="mx-auto w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-700 flex items-center justify-center shadow-lg">

                    <span class="text-2xl text-white">
                        💳
                    </span>

                </div>


                <h1 class="mt-5 text-3xl font-bold text-gray-900 dark:text-gray-100">
                    AMEPSO
                </h1>


                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Secure digital wallet & electricity payments
                </p>

            </div>


            {{-- Login Card --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-3xl shadow-xl overflow-hidden">


                {{-- Card Header --}}
                <div class="px-6 sm:px-8 pt-7">

                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                        Welcome back
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Sign in to access your AMEPSO wallet.
                    </p>

                </div>


                {{-- Session Status --}}
                <div class="px-6 sm:px-8 pt-5">

                    <x-auth-session-status
                        class="mb-4"
                        :status="session('status')"
                    />

                </div>


                {{-- Login Form --}}
                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="px-6 sm:px-8 pt-2 pb-8"
                >

                    @csrf


                    {{-- Email --}}
                    <div>

                        <x-input-label
                            for="email"
                            :value="__('Email address')"
                            class="text-gray-700 dark:text-gray-300 font-semibold"
                        />


                        <x-text-input
                            id="email"
                            class="block mt-2 w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-blue-500 focus:ring-blue-500"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="you@example.com"
                        />


                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Password --}}
                    <div class="mt-5">

                        <x-input-label
                            for="password"
                            :value="__('Password')"
                            class="text-gray-700 dark:text-gray-300 font-semibold"
                        />


                        <x-text-input
                            id="password"
                            class="block mt-2 w-full rounded-xl border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                        />


                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Remember Me --}}
                    <div class="mt-5">

                        <label
                            for="remember_me"
                            class="inline-flex items-center cursor-pointer"
                        >

                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-blue-600 shadow-sm focus:ring-blue-500 dark:focus:ring-blue-500"
                                name="remember"
                            >

                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Remember me') }}
                            </span>

                        </label>

                    </div>


                    {{-- Actions --}}
                    <div class="mt-7 flex flex-col gap-4">


                        <button
                            type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-sm hover:shadow transition"
                        >

                            <span>
                                Log in
                            </span>

                            <span>
                                →
                            </span>

                        </button>


                        @if (Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="text-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition"
                            >
                                {{ __('Forgot your password?') }}
                            </a>

                        @endif


                    </div>

                </form>

            </div>


            {{-- Security Notice --}}
            <div class="mt-6 flex items-start gap-3 px-2">

                <div class="w-9 h-9 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center flex-shrink-0">
                    🔐
                </div>

                <div>

                    <p class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                        Secure login
                    </p>

                    <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">
                        Your account and wallet information are protected by AMEPSO.
                    </p>

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

</x-guest-layout>