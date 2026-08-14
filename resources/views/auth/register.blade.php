<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            {{-- AMEPSO Branding --}}
            <div class="text-center mb-8">

                <div
                    class="mx-auto w-16 h-16 rounded-2xl
                           bg-gradient-to-br from-blue-600 to-indigo-700
                           flex items-center justify-center
                           shadow-lg"
                >
                    <span class="text-2xl text-white">
                        💳
                    </span>
                </div>

                <h1
                    class="mt-5 text-3xl font-bold
                           text-gray-900 dark:text-gray-100"
                >
                    AMEPSO
                </h1>

                <p
                    class="mt-2 text-sm
                           text-gray-500 dark:text-gray-400"
                >
                    Secure digital wallet & electricity payments
                </p>

            </div>


            {{-- Registration Card --}}
            <div
                class="bg-white dark:bg-gray-800
                       border border-gray-100 dark:border-gray-700
                       rounded-3xl
                       shadow-xl
                       overflow-hidden"
            >

                {{-- Header --}}
                <div class="px-6 sm:px-8 pt-7">

                    <h2
                        class="text-xl font-bold
                               text-gray-900 dark:text-gray-100"
                    >
                        Create your account
                    </h2>

                    <p
                        class="mt-1 text-sm
                               text-gray-500 dark:text-gray-400"
                    >
                        Create your AMEPSO wallet and link your ORMECO account.
                    </p>

                </div>


                {{-- Registration Form --}}
                <form
                    method="POST"
                    action="{{ route('register') }}"
                    class="px-6 sm:px-8 pt-6 pb-8"
                >

                    @csrf


                    {{-- Name --}}
                    <div>

                        <x-input-label
                            for="name"
                            :value="__('Full name')"
                            class="text-gray-700 dark:text-gray-300 font-semibold"
                        />

                        <x-text-input
                            id="name"
                            class="block mt-2 w-full
                                   rounded-xl
                                   border-gray-200
                                   dark:border-gray-600
                                   dark:bg-gray-700
                                   dark:text-gray-100
                                   focus:border-blue-500
                                   focus:ring-blue-500"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Enter your full name"
                        />

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Email --}}
                    <div class="mt-5">

                        <x-input-label
                            for="email"
                            :value="__('Email address')"
                            class="text-gray-700 dark:text-gray-300 font-semibold"
                        />

                        <x-text-input
                            id="email"
                            class="block mt-2 w-full
                                   rounded-xl
                                   border-gray-200
                                   dark:border-gray-600
                                   dark:bg-gray-700
                                   dark:text-gray-100
                                   focus:border-blue-500
                                   focus:ring-blue-500"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autocomplete="username"
                            placeholder="you@example.com"
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />

                    </div>


                    {{-- ORMECO Account Number --}}
                    <div class="mt-5">

                        <x-input-label
                            for="ormeco_account_number"
                            :value="__('ORMECO Account Number')"
                            class="text-gray-700 dark:text-gray-300 font-semibold"
                        />

                        <x-text-input
                            id="ormeco_account_number"
                            class="block mt-2 w-full
                                   rounded-xl
                                   border-gray-200
                                   dark:border-gray-600
                                   dark:bg-gray-700
                                   dark:text-gray-100
                                   focus:border-blue-500
                                   focus:ring-blue-500"
                            type="text"
                            name="ormeco_account_number"
                            :value="old('ormeco_account_number')"
                            required
                            autocomplete="off"
                            inputmode="numeric"
                            placeholder="Enter your ORMECO account number"
                        />

                        <p
                            class="mt-2 text-xs
                                   text-gray-500 dark:text-gray-400"
                        >
                            Enter the ORMECO account number associated with
                            your electricity service.
                        </p>

                        <x-input-error
                            :messages="$errors->get('ormeco_account_number')"
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
                            class="block mt-2 w-full
                                   rounded-xl
                                   border-gray-200
                                   dark:border-gray-600
                                   dark:bg-gray-700
                                   dark:text-gray-100
                                   focus:border-blue-500
                                   focus:ring-blue-500"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Create a password"
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Confirm Password --}}
                    <div class="mt-5">

                        <x-input-label
                            for="password_confirmation"
                            :value="__('Confirm password')"
                            class="text-gray-700 dark:text-gray-300 font-semibold"
                        />

                        <x-text-input
                            id="password_confirmation"
                            class="block mt-2 w-full
                                   rounded-xl
                                   border-gray-200
                                   dark:border-gray-600
                                   dark:bg-gray-700
                                   dark:text-gray-100
                                   focus:border-blue-500
                                   focus:ring-blue-500"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                        />

                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-2"
                        />

                    </div>


                    {{-- Register Button --}}
                    <div class="mt-7">

                        <button
                            type="submit"
                            class="w-full
                                   inline-flex
                                   items-center
                                   justify-center
                                   gap-2
                                   py-3.5
                                   bg-blue-600
                                   hover:bg-blue-700
                                   text-white
                                   font-bold
                                   rounded-xl
                                   shadow-sm
                                   hover:shadow
                                   transition"
                        >

                            <span>
                                Create account
                            </span>

                            <span>
                                →
                            </span>

                        </button>

                    </div>


                    {{-- Login Link --}}
                    <div
                        class="mt-6
                               pt-5
                               border-t
                               border-gray-200
                               dark:border-gray-700
                               text-center"
                    >

                        <p
                            class="text-sm
                                   text-gray-500
                                   dark:text-gray-400"
                        >
                            Already have an AMEPSO account?
                        </p>

                        <a
                            href="{{ route('login') }}"
                            class="inline-block mt-2
                                   text-sm
                                   font-semibold
                                   text-blue-600
                                   dark:text-blue-400
                                   hover:text-blue-700
                                   dark:hover:text-blue-300"
                        >
                            Log in
                        </a>

                    </div>

                </form>

            </div>


            {{-- Security Notice --}}
            <div
                class="mt-6
                       flex
                       items-start
                       gap-3
                       px-2"
            >

                <div
                    class="w-9 h-9
                           rounded-xl
                           bg-green-100
                           dark:bg-green-900/40
                           flex
                           items-center
                           justify-center
                           flex-shrink-0"
                >
                    🔐
                </div>

                <div>

                    <p
                        class="text-xs
                               font-semibold
                               text-gray-700
                               dark:text-gray-300"
                    >
                        Secure registration
                    </p>

                    <p
                        class="mt-1
                               text-xs
                               leading-5
                               text-gray-500
                               dark:text-gray-400"
                    >
                        Your account and ORMECO information are securely
                        linked to your AMEPSO account.
                    </p>

                </div>

            </div>


            {{-- Footer --}}
            <div class="mt-8 text-center">

                <p
                    class="text-xs
                           text-gray-400
                           dark:text-gray-500"
                >
                    AMEPSO • Secure digital wallet and electricity payments
                </p>

            </div>

        </div>

    </div>

</x-guest-layout>