<x-guest-layout>
    {{-- <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="company_id" value="{{ __('Company ID') }}" />
                <x-input id="company_id" class="block mt-1 w-full" type="number" name="company_id" :value="old('company_id')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card> --}}
    <div class=" tracking-wider" style="font-family: 'Poppins', san-serif;">
        <div class="flex justify-around">
            <div class="transition-transform duration-1000 transform translate-y-100 loading mt-52" id="titles">
                <div class="text-white font-bold text-4xl ">ORO INTEGRATED COOPERATIVE</div>
                <div class="text-white text-2xl mt-2">YOUTH SAVERS CLUB</div>
            </div>
            <div class="mt-52 transition-transform duration-1000 transform translate-x-100 loading1" id="form">

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <div class="text-2xl font-bold text-green-700">
                        Hello there!
                    </div>
                    <div class="text-2xl font-bold text-green-700 mb-8">Welcome Back.</div>
                    <div class="">
                        <x-label for="company_id" value="{{ __('Company ID') }}" />

                        <div class="relative">
                            <input id="company_id" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg mt-1"
                                type="number" name="company_id" :value="old('company_id')"
                                placeholder="Enter company ID" required autofocus
                                onFocus="this.parentNode.classList.add('focused')"
                                onBlur="this.parentNode.classList.remove('focused')">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                                <!-- Icon markup or Font Awesome icon class -->
                                <i class="fas fa-user text-slate-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />

                        <div class="relative">
                            <input id="password" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg mt-1"
                                type="password" name="password" required autocomplete="current-password"
                                placeholder="Enter Password" onFocus="this.parentNode.classList.add('focused')"
                                onBlur="this.parentNode.classList.remove('focused')">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                                <!-- Icon markup or Font Awesome icon class -->
                                <i class="fas fa-lock text-slate-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button type="submit"
                            class="ml-4 inline-flex items-center px-4 py-2 bg-green-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-green-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-gren-500 focus:ring-offset-2 dark:focus:ring-offset-green-800 transition ease-in-out duration-150">
                            {{ __('Log in') }}
                        </button>
                    </div>

                </form>
            </div>


        </div>
    </div>
    <div id="loadingOverlay">
        <img src="{{ asset('img/load.gif') }}" alt="loading" id="loadingSpinner" />
    </div>
    @push('style')
        <style>
            body {
                background-image: url('{{ asset('img/web-back.png') }}');
                background-size: cover;
                background-repeat: no-repeat;
                height:100vh;
                width:100%;
                transition: all 3s ease;
                opacity: 0;

            }

            body.loaded {
                opacity: 1;
            }

            .focused i {
                color: blue;
                transition: color 0.3s ease;
            }

            .loading {
                opacity: 0;
                transform: translateY(100px);
            }

            .loading.loaded {
                opacity: 1;
                transform: translateY(-20px);
            }

            .loading1 {
                opacity: 0;
                transform: translateX(100px);
            }

            .loading1.loaded1 {
                opacity: 1;
                transform: translateX(-20px);
            }

            #loadingOverlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9999;
                display: none;
            }

            #loadingSpinner {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
    @endpush

    @push('script')
        <script>
            window.onload = function() {
                var element = document.getElementById('titles');
                var form = document.getElementById('form')
                element.classList.add('loaded');
                form.classList.add('loaded1');
                document.body.classList.add('loaded');
            };
            $(document).ready(function() {
                $('#loginForm').on('submit', function() {
                    $('#loadingOverlay').show();
                });
            })
        </script>
    @endpush
</x-guest-layout>
